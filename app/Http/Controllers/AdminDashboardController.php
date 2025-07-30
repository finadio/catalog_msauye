<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Article;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $umkmCount = Umkm::count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $articleCount = Article::count();

        $pendingUmkmCount = User::where('status', 'pending')->count();
        $pendingProductCount = Product::where('status_id', '1')->count();

        return view('admin.dashboard', compact('pendingUmkmCount','pendingProductCount','umkmCount', 'productCount', 'categoryCount', 'articleCount'));
    }
}
