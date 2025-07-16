<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
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
        return view('admin.dashboard', compact('umkmCount', 'productCount', 'categoryCount', 'articleCount'));
    }
}
