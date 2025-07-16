<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Category;
use App\Models\Article;

class PublicController extends Controller
{
    public function home(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['umkm', 'category'])
            ->when($request->q, fn($q) => $q->where('name', 'like', '%'.$request->q.'%'))
            ->when($request->kategori, fn($q) => $q->where('category_id', $request->kategori))
            ->latest()->paginate(12);
        return view('public.home', compact('categories', 'products'));
    }

    public function produkDetail($id)
    {
        $product = Product::with('umkm')->findOrFail($id);
        return view('public.produk_detail', compact('product'));
    }

    public function umkmDetail($id)
    {
        $umkm = Umkm::with('products')->findOrFail($id);
        return view('public.umkm_detail', compact('umkm'));
    }

    public function artikel()
    {
        $articles = Article::latest()->paginate(8);
        return view('public.artikel', compact('articles'));
    }

    public function artikelDetail($id)
    {
        $article = Article::findOrFail($id);
        return view('public.artikel_detail', compact('article'));
    }

    public function tentang()
    {
        return view('public.tentang');
    }
}
