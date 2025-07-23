<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth; //

class UmkmProductController extends Controller
{
    public function index(Request $request) //
    {
        $umkm = Auth::user(); //
        $query = $umkm->products()->with('status'); //

        // Terapkan filter pencarian jika parameter 'search' ada
        if ($request->filled('search')) { //
            $searchQuery = $request->input('search'); //
            $query->where('name', 'like', '%' . $searchQuery . '%'); //
        }

        // Terapkan pengurutan (sorting)
        $sortBy = $request->input('sort_by', 'updated_at'); // Default: diurutkan berdasarkan 'updated_at'
        $sortOrder = $request->input('sort_order', 'desc'); // Default: urutan menurun (descending)

        // Validasi kolom 'sort_by' yang diizinkan untuk mencegah injeksi kolom
        $allowedSortBy = ['name', 'price', 'updated_at'];
        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'updated_at'; // Kembali ke default jika tidak valid
        }

        // Validasi urutan 'sort_order'
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc'; // Kembali ke default jika tidak valid
        }

        $products = $query->orderBy($sortBy, $sortOrder)
                          ->paginate(10)
                          ->appends($request->query()); // Pertahankan parameter pencarian dan pengurutan saat paginasi
        
        $categories = Category::all(); //
        return view('umkm_produk', compact('products', 'categories', 'umkm')); //
    }

    public function create() //
    {
        $categories = Category::all(); //
        return view('umkm_produkcreate', compact('categories')); //
    }

    public function store(Request $request) //
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|max:2048',
        ]); //

        $data = [
            'name' => $request->nama,
            'description' => $request->deskripsi,
            'price' => $request->harga,
            'category_id' => $request->category_id,
            'umkm_id' => Auth::id(), //
            'status_id' => 1, // default pending
        ]; //

        if ($request->hasFile('foto')) { //
            $data['photo'] = $request->file('foto')->store('produk', 'public'); // Simpan di 'public' disk
        } else {
            // Jika tidak ada foto diunggah, gunakan dummy. Pastikan foto dummy tersedia di public/img/
            $dummyImages = [
                'produk-dummy-1.jpg', 'produk-dummy-2.jpg', 'produk-dummy-3.jpg',
                'produk-dummy-4.jpg', 'produk-dummy-5.jpg', 'produk-dummy-6.jpg',
            ];
            $data['photo'] = $dummyImages[array_rand($dummyImages)]; // Pilih acak dari dummy
        }

        Product::create($data); //

        return redirect()->route('umkm_produk')->with('success', 'Produk ditambahkan.'); //
    }

    public function edit($id) //
    {
        $product = Product::with('umkm')->findOrFail($id); //
        $categories = Category::all(); //
        return view('umkm_produkedit', compact('product', 'categories')); //
    }

    public function update(Request $request, $id) //
    {
        $product = Product::findOrFail($id); //
        $this->authorize('update', $product); //

        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|max:2048',
        ]); //

        $updateData = [
            'name' => $request->nama,
            'description' => $request->deskripsi,
            'price' => $request->harga,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('foto')) { //
            // Hapus foto lama jika ada dan bukan dummy
            if ($product->photo && !Str::startsWith($product->photo, 'produk-dummy')) {
                \Storage::disk('public')->delete($product->photo);
            }
            $updateData['photo'] = $request->file('foto')->store('produk', 'public'); // Simpan di 'public' disk
        }

        $product->update($updateData); //
        return redirect()->route('umkm_produk')->with('success', 'Produk diperbarui.'); //
    }

    public function search(Request $request) //
    {
        // Metode ini sekarang menjadi redundan untuk daftar produk utama,
        // karena logika pencarian sudah ditangani di metode index.
        // Jika ada penggunaan AJAX spesifik untuk search yang terpisah,
        // metode ini bisa dipertahankan. Untuk konteks ini, asumsikan index
        // sudah menangani pencarian utama.
        $query = $request->input('search'); //

        $products = Product::with('status') //
            ->where('umkm_id', auth()->user()->id) //
            ->when(request('search'), function ($query) { //
                $query->where('name', 'like', '%' . request('search') . '%'); //
            })
            ->orderBy('updated_at', 'desc') //
            ->paginate(5); //

        return response()->json([
            'html' => view('partials.umkm_produk_table', compact('products'))->render()
        ]); //
    }

    public function destroy($id) //
    {
        $product = Product::findOrFail($id); //
        $this->authorize('delete', $product); //

        // Hapus foto produk jika ada dan bukan dummy
        if ($product->photo && !Str::startsWith($product->photo, 'produk-dummy')) {
            \Storage::disk('public')->delete($product->photo);
        }
        
        $product->delete(); //

        return back()->with('success', 'Produk dihapus.'); //
    }
}