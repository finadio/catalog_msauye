<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Category;
use App\Models\Article;
use App\Models\ProductStatus;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan produk dan artikel terbaru.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['umkm', 'category', 'status'])
            ->whereHas('status', function($q) {
                $q->where('name', 'approved');
            })
            ->when($request->q, fn($q) => $q->where('name', 'like', '%'.$request->q.'%'))
            ->when($request->kategori, fn($q) => $q->where('category_id', $request->kategori))
            ->latest()->paginate(12);

        // Mengambil artikel terbaru untuk ditampilkan di beranda (misal 3 artikel)
        $articles = Article::latest()->take(3)->get();

        // Lewatkan $articles ke view
        return view('public.home', compact('categories', 'products', 'articles'));
    }

    /**
     * Menampilkan detail produk.
     *
     * @param int $id ID Produk
     * @return \Illuminate\View\View
     */
    public function produkDetail($id)
    {
        $product = Product::with(['umkm', 'status'])
            ->whereHas('status', function($q) {
                $q->where('name', 'approved');
            })
            ->findOrFail($id);
        return view('public.produk_detail', compact('product'));
    }

    /**
     * Menampilkan detail UMKM.
     *
     * @param int $id ID UMKM
     * @return \Illuminate\View\View
     */
    public function umkmDetail($id)
    {
        $umkm = Umkm::with(['products' => function($query) {
            $query->whereHas('status', function($q) {
                $q->where('name', 'approved');
            });
        }, 'products.status'])->findOrFail($id);
        return view('public.umkm_detail', compact('umkm'));
    }

    /**
     * Menampilkan daftar semua UMKM dengan filter dan pencarian.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function umkmIndex(Request $request)
    {
        // Membangun query untuk UMKM
        $query = Umkm::query();

        // Filter berdasarkan kategori jika parameter 'kategori' ada
        // Asumsi: UMKM memiliki relasi ke kategori atau ada kolom kategori di tabel UMKM.
        // Jika UMKM tidak langsung memiliki kategori, Anda mungkin perlu menyesuaikan ini.
        // Untuk saat ini, saya akan mengasumsikan ada kolom 'category_id' di tabel umkms
        // atau kita akan menggunakan relasi produk UMKM untuk memfilter UMKM berdasarkan kategori produk.
        // Namun, karena UMKM tidak memiliki category_id langsung, kita akan fokus pada search bar dulu.
        // Jika Anda ingin filter kategori untuk UMKM, Anda perlu menambahkan kolom category_id di tabel umkms
        // atau membuat pivot table jika satu UMKM bisa memiliki banyak kategori.
        // Untuk demo ini, saya akan tambahkan filter kategori berdasarkan produk yang dimiliki UMKM.
        if ($request->filled('kategori')) {
            $categoryId = $request->kategori;
            $query->whereHas('products', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        // Pencarian berdasarkan query 'q' (nama, deskripsi, dll.)
        if ($request->filled('q')) {
            $searchQuery = $request->q;
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('description', 'like', '%'.$searchQuery.'%')
                  ->orWhere('address', 'like', '%'.$searchQuery.'%')
                  ->orWhere('phone', 'like', '%'.$searchQuery.'%')
                  ->orWhere('whatsapp', 'like', '%'.$searchQuery.'%')
                  ->orWhere('instagram', 'like', '%'.$searchQuery.'%')
                  ->orWhere('tiktok', 'like', '%'.$searchQuery.'%')
                  ->orWhere('website', 'like', '%'.$searchQuery.'%');
            });
        }

        $umkms = $query->latest()->paginate(12);
        $categories = Category::all(); // Ambil semua kategori untuk dropdown filter

        return view('public.umkm_index', compact('umkms', 'categories'));
    }

    /**
     * Menampilkan daftar semua artikel dengan filter dan pencarian.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function artikel(Request $request)
    {
        $query = Article::query();

        // Filter berdasarkan tipe artikel jika parameter 'tipe' ada
        if ($request->filled('tipe')) {
            $query->where('type', $request->tipe);
        }

        // Pencarian berdasarkan query 'q' (judul atau konten)
        if ($request->filled('q')) {
            $searchQuery = $request->q;
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%'.$searchQuery.'%')
                  ->orWhere('content', 'like', '%'.$searchQuery.'%');
            });
        }

        $articles = $query->latest()->paginate(8);

        // Ambil semua tipe artikel unik untuk dropdown filter
        $articleTypes = Article::select('type')->distinct()->get()->pluck('type');

        return view('public.artikel', compact('articles', 'articleTypes'));
    }

    /**
     * Menampilkan detail artikel.
     *
     * @param int $id ID Artikel
     * @return \Illuminate\View\View
     */
    public function artikelDetail($id)
    {
        $article = Article::findOrFail($id);
        return view('public.artikel_detail', compact('article'));
    }

    /**
     * Menampilkan halaman tentang kami.
     *
     * @return \Illuminate\View\View
     */
    public function tentang()
    {
        return view('public.tentang');
    }

    /**
     * Menampilkan daftar semua produk dengan filter dan pencarian.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
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

    /**
     * Mengambil data produk melalui AJAX dengan filter dan pencarian.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
