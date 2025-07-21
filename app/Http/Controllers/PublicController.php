<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Category;
use App\Models\Article; // Pastikan ini di-import
use App\Models\ProductStatus;

class PublicController extends Controller
{
    public function home(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['umkm', 'category', 'status'])
            ->when($request->q, fn($q) => $q->where('name', 'like', '%'.$request->q.'%'))
            ->when($request->kategori, fn($q) => $q->where('category_id', $request->kategori))
            ->latest()->paginate(12);

        // Tambahkan pengambilan data artikel di sini
        $articles = Article::latest()->get(); // Mengambil semua artikel, nanti akan dibatasi di view dengan take(3)

        // Lewatkan $articles ke view
        return view('public.home', compact('categories', 'products', 'articles'));
    }

    public function produkDetail($id)
    {
        $product = Product::with(['umkm', 'status'])->findOrFail($id);
        return view('public.produk_detail', compact('product'));
    }

    public function umkmDetail($id)
    {
        $umkm = Umkm::with(['products.status'])->findOrFail($id);
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

    // Tambahkan metode ini untuk halaman daftar produk
    public function produkIndex(Request $request)
    {
        $query = Product::query()->with(['umkm', 'category', 'status'])
                        ->whereHas('status', function($q){ // Hanya tampilkan produk dengan status 'approved'
                            $q->where('name', 'approved');
                        });

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('name', 'like', "%$q%")
                  ->orWhere('description', 'like', "%$q%")
                  ->orWhereHas('umkm', function($u) use ($q) {
                      $u->where('name', 'like', "%$q%");
                  });
        }
        if ($request->filled('kategori')) {
            $query->where('category_id', $request->kategori);
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('public.produk_index', compact('products', 'categories'));
    }

    // Tambahkan metode ini untuk endpoint AJAX produk
    public function produkAjax(Request $request)
    {
        $query = Product::query()->with(['umkm', 'category', 'status'])
                        ->whereHas('status', function($q){
                            $q->where('name', 'approved');
                        });

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('name', 'like', "%$q%")
                  ->orWhere('description', 'like', "%$q%")
                  ->orWhereHas('umkm', function($u) use ($q) {
                      $u->where('name', 'like', "%$q%");
                  });
        }
        if ($request->filled('kategori')) {
            $query->where('category_id', $request->kategori);
        }

        $products = $query->latest()->paginate(12);

        // Format data untuk JSON (bisa disesuaikan sesuai kebutuhan frontend)
        $data = [
            'products' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ];
        return response()->json($data);
    }
}