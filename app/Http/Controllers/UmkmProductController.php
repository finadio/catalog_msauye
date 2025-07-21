<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UmkmProductController extends Controller
{
    public function index()
    {
        $products = Auth::user()->products()->with('status')->get();
        return view('umkmproduk', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('umkmproduk', ['createMode' => true, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric',
            'kategori_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk');
        }

        $data['user_id'] = Auth::id();
        $data['status_id'] = 1; // default pending
        Product::create($data);

        return redirect()->route('umkm.produk')->with('success', 'Produk ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('umkmproduk', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric',
            'kategori_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk');
        }

        $product->update($data);
        return redirect()->route('umkm.produk')->with('success', 'Produk diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();

        return back()->with('success', 'Produk dihapus.');
    }
}
