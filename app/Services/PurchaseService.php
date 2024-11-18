<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\NoRekening;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class PurchaseService
{
    public function __construct(
        protected array $purchaseData
    ) {
    }

    public function generateNoteNumber(): string
    {
        $userCode = request()->user()->code;

        $purchaseMethodCode = $this->getPurchaseMethodCode($this->purchaseData['method']);

        $newPurchaseNumber = $this->getLastPurchaseNumber();

        return $purchaseMethodCode . $userCode . '-' . $newPurchaseNumber;
    }

    public function getLastPurchaseNumber(): int
    {
        $lastPurchase = Purchase::query()->latest()->first();
        return is_null($lastPurchase) ? 1 : (int)(explode('-', $lastPurchase->note_number)[1]) + 1;
    }

    public function getPurchaseMethodCode(int $purchaseMethod): string
    {
        $setting = Setting::query()->first();
        if (!$setting) {
            throw new \Exception('Pengaturan Code Belum Diatur.');
        }

        $purchaseMethodcode = '';
        switch ($purchaseMethod) {
            case 0:
                $purchaseMethodcode = $setting->cash_purchase_code;
                break;

            case 1:
                $purchaseMethodcode = $setting->hutang_purchase_code;
                break;

            case 2:
                $purchaseMethodcode = $setting->transfer_purchase_code;
                break;

            default:
                throw new \Exception('Metode Pembelian Tidak Sesuai.');
        }

        return $purchaseMethodcode;
    }

    public function savePurchase(): Purchase
    {
        $purchase = Purchase::query()->create([
            'note_number' => $this->generateNoteNumber(),
            'date' => $this->purchaseData['date'],
            'supplier' => $this->purchaseData['supplier'],
            'store_name' => $this->purchaseData['store_name'],
            'amount_paid' => $this->purchaseData['amount_paid'],
            'method' => $this->purchaseData['method'],
        ]);

        $this->savePurchaseDetails($purchase);
        return $purchase;
    }

    public function savePurchaseDetails(Purchase $purchase): void
    {
        $purchase->purchaseDetails()->saveMany(array_map(function (array $val) {
            return new PurchaseDetail([
                'product_id' => $val['product_id'],
                'amount' => $val['amount'],
                'price' => $val['price'],
            ]);
        }, $this->purchaseData['purchase_details']));
    }

    public function saveDebt(Purchase $purchase): void
    {

    }

    public function saveTransfer(Purchase $purchase): void
    {
        $purchaseData = $this->purchaseData;
        $bank_id = (Bank::query()->findOr($this->purchaseData['bank_id'], function() use ($purchaseData){
            return Bank::query()->create([
                'name' => $purchaseData['bank_id']
            ]);
        }))->id;
        $no_rekening_id = (NoRekening::query()->findOr($this->purchaseData['no_rekening_id'], function() use ($purchaseData, $bank_id){
            return NoRekening::query()->create([
                'bank_id' => $bank_id,
                'account_number' => $purchaseData['no_rekening_id'],
                'name' => $purchaseData['account_name']
            ]);
        }))->id;
        $purchase->transferPurchase()->create([
            'no_rekening_id' => $no_rekening_id
        ]);
    }
}
