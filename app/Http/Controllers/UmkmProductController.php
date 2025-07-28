<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan UMKM dari user yang sedang login
        $umkm = Auth::user()->umkm;

        // Mendapatkan produk berdasarkan umkm_id yang terkait DENGAN PAGINASI
        $products = Product::where('umkm_id', $umkm->id)->paginate(10); // Menggunakan paginate(10)

        return view('umkm_produk', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('umkm_produkcreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input, termasuk foto
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Pastikan category_id valid
            'wa' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'telepon' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aturan untuk unggahan foto
        ]);

        $user = Auth::user();
        $umkm = $user->umkm; // Dapatkan UMKM yang terkait dengan user yang sedang login

        // Siapkan data untuk produk
        $productData = [
            'umkm_id' => $umkm->id, // Gunakan ID UMKM yang terkait
            'name' => $validatedData['nama'],
            'description' => $validatedData['deskripsi'],
            'price' => $validatedData['harga'],
            'category_id' => $validatedData['category_id'],
            'location' => $umkm->address, // Menggunakan alamat UMKM sebagai lokasi produk
            'show_price' => true, // Default atau bisa dari input jika ada checkbox
            'whatsapp' => $validatedData['wa'],
            'instagram' => $validatedData['instagram'],
            'tiktok_shop' => $validatedData['tiktok'],
            'website' => $validatedData['website'],
            'telepon' => $validatedData['telepon'],
            // Dapatkan status_id untuk 'pending' dari tabel product_statuses
            'status_id' => ProductStatus::where('name', 'pending')->first()->id,
        ];

        // LOGIKA UNTUK MENANGANI UNGGAHAN FOTO
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            // Pastikan nama file unik untuk menghindari tabrakan
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Simpan file di direktori 'products' di dalam public storage disk
            $path = $image->storeAs('products', $fileName, 'public');

            // Simpan path relatif ke database (misal: products/namafileunik.jpg)
            $productData['photo'] = $path;
        } else {
            // Jika tidak ada foto diunggah, atur kolom 'photo' menjadi null atau path default
            $productData['photo'] = null; // Atur ke null jika foto opsional
        }

        // Buat produk baru
        Product::create($productData);

        return redirect()->route('umkm_produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Pastikan produk ini milik UMKM yang sedang login
        if (Auth::user()->umkm->id !== $product->umkm_id) {
            abort(403); // Akses ditolak jika bukan produk UMKMnya
        }

        $categories = Category::all();
        $statuses = ProductStatus::all(); // Jika Anda ingin mengedit status dari form UMKM
        return view('umkm_produkedit', compact('product', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Pastikan produk ini milik UMKM yang sedang login
        if (Auth::user()->umkm->id !== $product->umkm_id) {
            abort(403); // Akses ditolak jika bukan produk UMKMnya
        }

        // Validasi data input, termasuk foto (name input di form edit adalah 'name', 'description', dll)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'wa' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'telepon' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aturan untuk unggahan foto
            'status_id' => 'required|exists:product_statuses,id', // Jika status bisa diubah di form edit
        ]);

        $productData = $validatedData;

        // LOGIKA UNTUK MENANGANI UNGGAHAN FOTO SAAT EDIT
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada dan file tersebut ada di storage
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }

            $image = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $fileName, 'public');
            $productData['photo'] = $path; // Simpan path relatif foto baru
        } else {
            // Jika tidak ada foto baru diunggah, pertahankan foto yang sudah ada di database
            // Jika Anda ingin opsi untuk menghapus foto dengan tidak mengganti, Anda perlu menambahkan
            // checkbox "Hapus Foto" di form.
            $productData['photo'] = $product->photo;
        }

        // Perbarui produk
        $product->update($productData);

        return redirect()->route('umkm_produk')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Pastikan produk ini milik UMKM yang sedang login
        if (Auth::user()->umkm->id !== $product->umkm_id) {
            abort(403); // Akses ditolak
        }
        
        // Hapus foto terkait dari penyimpanan sebelum menghapus produk dari database
        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('umkm_produk')->with('success', 'Produk berhasil dihapus!');
    }
}