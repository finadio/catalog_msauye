<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.kategori.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Metode ini biasanya untuk menampilkan detail satu kategori, jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $kategori) // Menggunakan Route Model Binding untuk Category
    {
        // Variabel $kategori sudah berisi objek Category yang sesuai dari database.
        // Kita meneruskannya ke view.
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $kategori) // Menggunakan Route Model Binding
    {
        $request->validate([
            // Memastikan nama unik, kecuali untuk kategori yang sedang diedit ($kategori->id)
            'name' => 'required|string|max:255|unique:categories,name,' . $kategori->id,
        ]);

        $kategori->update($request->only('name'));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $kategori) // Menggunakan Route Model Binding
    {
        // Sebelum menghapus kategori, Anda mungkin ingin memeriksa apakah ada produk yang terkait
        // Jika ada, Anda perlu menangani mereka (misalnya, set ke null, hapus produk, atau cegah penghapusan)
        if ($kategori->products()->count() > 0) {
            return redirect()->route('admin.kategori.index')->with('error', 'Tidak dapat menghapus kategori karena masih ada produk yang terkait.');
        }

        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}