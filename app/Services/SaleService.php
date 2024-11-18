<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\NoRekening;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Setting;

class SaleService
{
    public function __construct(
        protected array $saleData
    ) {
    }

    public function validateProductAmount(): void
    {
        foreach ($this->saleData['sale_details'] as $key => $sale_detail) {
            $product = ProductPrice::query()->find($sale_detail['product_price_id'])?->product;
            if ($product && $sale_detail['amount'] > $product->currentStock) {
                throw new \Exception("Jumlah produk " . $product->name . " melebihi stok.");
                break;
            }
        }
    }

    public function generateNoteNumber(): string
    {
        $userCode = request()->user()->code;

        $sale_method_code = $this->getSaleMethodCode($this->saleData['method']);

        $newSaleNumber = $this->getLastSaleNumber();

        return $sale_method_code . $userCode . '-' . $newSaleNumber;
    }

    public function getLastSaleNumber(): int
    {
        $lastSale = Sale::query()->latest()->first();
        return is_null($lastSale) ? 1 : (int)(explode('-', $lastSale->note_number)[1]) + 1;
    }

    public function getSaleMethodCode(int $saleMethod): string
    {
        $setting = Setting::query()->first();
        if (!$setting) {
            throw new \Exception('Pengaturan Code Belum Diatur.');
        }

        $sale_method_code = '';
        switch ($saleMethod) {
            case 0:
                $sale_method_code = $setting->cash_sale_code;
                break;

            case 1:
                $sale_method_code = $setting->piutang_sale_code;
                break;

            case 2:
                $sale_method_code = $setting->transfer_sale_code;
                break;

            default:
                throw new \Exception('Metode Pembelian Tidak Sesuai.');
        }

        return $sale_method_code;
    }

    public function saveSale(): Sale
    {
        $this->validateProductAmount();
        $sale = Sale::query()->create([
            'note_number' => $this->generateNoteNumber(),
            'date' => $this->saleData['date'],
            'consumer' => $this->saleData['consumer'],
            'store_name' => $this->saleData['store_name'],
            'amount_paid' => $this->saleData['amount_paid'],
            'method' => $this->saleData['method'],
        ]);

        $this->saveSaleDetails($sale);
        return $sale;
    }

    public function saveSaleDetails(Sale $sale): void
    {
        $sale->saleDetails()->saveMany(array_map(function (array $val) {
            return new SaleDetail([
                'product_price_id' => $val['product_price_id'],
                'amount' => $val['amount'],
            ]);
        }, $this->saleData['sale_details']));
    }

    public function saveReceivable(Sale $sale): void
    {
        
    }

    public function saveTransfer(Sale $sale): void
    {
        $saleData = $this->saleData;
        $bank_id = (Bank::query()->findOr($this->saleData['bank_id'], function() use ($saleData){
            return Bank::query()->create([
                'name' => $saleData['bank_id']
            ]);
        }))->id;
        $no_rekening_id = (NoRekening::query()->findOr($this->saleData['no_rekening_id'], function() use ($saleData, $bank_id){
            return NoRekening::query()->create([
                'bank_id' => $bank_id,
                'account_number' => $saleData['no_rekening_id'],
                'name' => $saleData['account_name']
            ]);
        }))->id;
        $sale->transferSale()->create([
            'no_rekening_id' => $no_rekening_id
        ]);
    }
}
