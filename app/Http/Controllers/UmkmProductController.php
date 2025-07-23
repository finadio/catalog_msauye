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
        $umkm = Auth::user();
        $products = Auth::user()->products()->get();
        $products = Auth::user()->products()->with('status')->paginate(10);
        $categories = Category::all();
        return view('umkm_produk', compact('products', 'categories', 'umkm'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('umkm_produkcreate', compact('categories'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = [
        'name' => $request->nama,
        'description' => $request->deskripsi,
        'price' => $request->harga,
        'category_id' => $request->category_id,
        'umkm_id' => Auth::id(),
        'status_id' => 1, // default pending
    ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk');
        }

        $data['umkm_id'] = Auth::id();
        $data['status_id'] = 1; // default pending
        Product::create($data);

        return redirect()->route('umkm_produk')->with('success', 'Produk ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::with('umkm')->findOrFail($id);
        $categories = Category::all();
        return view('umkm_produkedit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk');
        }

        $product->update($data);
        return redirect()->route('umkm_produk')->with('success', 'Produk diperbarui.');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $products = Product::with('status')
            ->where('umkm_id', auth()->user()->id)
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

            return response()->json([
            'html' => view('partials.umkm_produk_table', compact('products'))->render()
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();

        return back()->with('success', 'Produk dihapus.');
    }
}
