<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Pastikan ini diimpor untuk logging

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
        // Pastikan $umkm tidak null sebelum mencoba mengakses $umkm->id
        $products = $umkm ? Product::where('umkm_id', $umkm->id)->paginate(10) : collect();

        return view('umkm_produk', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Otorisasi untuk membuat produk
        $this->authorize('create', Product::class);

        $categories = Category::all();
        return view('umkm_produkcreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Otorisasi untuk menyimpan produk
        $this->authorize('create', Product::class);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'wa' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'telepon' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $umkm = $user->umkm;

        // Penting: Pastikan user memiliki UMKM sebelum mencoba membuat produk
        if (!$umkm) {
            return redirect()->back()->with('error', 'Anda harus memiliki profil UMKM untuk menambahkan produk.');
        }

        $productData = [
            'umkm_id' => $umkm->id,
            'name' => $validatedData['nama'],
            'description' => $validatedData['deskripsi'],
            'price' => $validatedData['harga'],
            'category_id' => $validatedData['category_id'],
            'location' => $umkm->address,
            'show_price' => true,
            'whatsapp' => $validatedData['wa'],
            'instagram' => $validatedData['instagram'],
            'tiktok_shop' => $validatedData['tiktok'],
            'website' => $validatedData['website'],
            'telepon' => $validatedData['telepon'],
            'status_id' => ProductStatus::where('name', 'pending')->first()->id,
        ];

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $fileName, 'public');
            $productData['photo'] = $path;
        } else {
            $productData['photo'] = null;
        }

        Product::create($productData);

        return redirect()->route('umkm_produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Otorisasi untuk melihat produk (opsional, tergantung kebutuhan)
        $this->authorize('view', $product);
        // ... kode show ...
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product) // Pastikan tipenya Product
    {
        Log::info('--- UmkmProductController@edit Called ---');
        Log::info('Product object received by edit method (before policy): ' . json_encode($product));

        // Pemeriksaan tambahan untuk memastikan objek produk valid
        // Jika Route Model Binding gagal, $product akan kosong atau null, dan ini akan memicu 404.
        if (!$product || !($product instanceof Product) || empty($product->id)) {
            Log::error('Route model binding FAILED. Product object is not valid or ID is missing.');
            abort(404, 'Produk tidak ditemukan atau tidak valid untuk diedit.');
        }

        Log::info('Attempting to authorize update for product ID: ' . $product->id);
        Log::info('Product umkm_id from controller: ' . $product->umkm_id); // Log dari controller
        Log::info('Authenticated User ID from controller: ' . Auth::id());

        $userUmkm = Auth::user()->umkm;
        if ($userUmkm) {
            Log::info('User UMKM ID from controller: ' . $userUmkm->id);
        } else {
            Log::warning('Authenticated user does not have an associated UMKM object in controller.');
        }

        // Panggil otorisasi melalui Policy. Ini akan memicu ProductPolicy@update.
        $this->authorize('update', $product);

        $categories = Category::all();
        $statuses = ProductStatus::all();
        return view('umkm_produkedit', compact('product', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Panggil otorisasi di sini juga
        $this->authorize('update', $product);

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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_id' => 'required|exists:product_statuses,id',
        ]);

        $productData = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'whatsapp' => $validatedData['wa'] ?? null,
            'instagram' => $validatedData['instagram'] ?? null,
            'tiktok_shop' => $validatedData['tiktok'] ?? null,
            'website' => $validatedData['website'] ?? null,
            'telepon' => $validatedData['telepon'] ?? null,
            'status_id' => $validatedData['status_id'],
        ];

        \Log::info('DEBUG: Mulai proses update produk', ['product_id' => $product->id]);
        if ($request->hasFile('photo')) {
            \Log::info('DEBUG: File foto ditemukan di request', ['original_name' => $request->file('photo')->getClientOriginalName()]);
            if ($product->photo && \Storage::disk('public')->exists($product->photo)) {
                \Log::info('DEBUG: Menghapus foto lama', ['old_photo' => $product->photo]);
                \Storage::disk('public')->delete($product->photo);
            }
            $image = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $fileName, 'public');
            \Log::info('DEBUG: Foto baru berhasil di-upload', ['path' => $path]);
            $productData['photo'] = $path;
        } else {
            \Log::info('DEBUG: Tidak ada file foto di request, menggunakan foto lama', ['old_photo' => $product->photo]);
            $productData['photo'] = $product->photo;
        }

        $product->update($productData);

        return redirect()->route('umkm_produk')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Panggil otorisasi di sini juga
        $this->authorize('delete', $product);

        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('umkm_produk')->with('success', 'Produk berhasil dihapus!');
    }
}
