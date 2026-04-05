<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MotorModel;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $brandsCount = Brand::count();
        $modelsCount = MotorModel::count();
        $productsCount = Product::count();
        $usersCount = User::count();
        $recentProducts = Product::with('model.brand')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'brandsCount', 'modelsCount', 'productsCount', 'usersCount', 'recentProducts'
        ));
    }
}
