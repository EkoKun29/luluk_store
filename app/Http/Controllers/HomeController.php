<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $purchases = Purchase::query()->latest()->get()->take(5);
        $sales = Sale::query()->latest()->get()->take(5);
        $usersCount = 0;

    // Cek role 'tokowinong' dan 'tokogabus'
    if (Role::where('name', 'tokowinong')->exists()) {
        $usersCount += User::role('tokowinong')->count();
    }

    if (Role::where('name', 'tokogabus')->exists()) {
        $usersCount += User::role('tokogabus')->count();
    }
        $productsCount = Product::count();
        $salesCount = Sale::count();
        $purchasesCount = Purchase::count();

        return view('home', compact('usersCount', 'productsCount', 'salesCount', 'purchasesCount', 'purchases', 'sales'));
    }
}
