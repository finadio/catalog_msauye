<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkm = auth()->user()->umkm;
        $products = $umkm ? $umkm->products()->with('category','status')->latest()->paginate(10) : collect();
        return view('umkm.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('umkm.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $umkm = auth()->user()->umkm;
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'photo' => 'required|image|max:2048',
        ]);
        $data = $request->only(['name','description','category_id','price']);
        $data['umkm_id'] = $umkm->id;
        $data['status_id'] = ProductStatus::where('name','pending')->first()->id ?? 1;
        $data['photo'] = $request->file('photo')->store('produk','public');
        Product::create($data);
        return redirect()->route('umkm.produk.index')->with('success','Produk berhasil ditambahkan, menunggu persetujuan admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $umkm = auth()->user()->umkm;
        $product = $umkm->products()->findOrFail($id);
        $categories = Category::all();
        return view('umkm.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $umkm = auth()->user()->umkm;
        $product = $umkm->products()->findOrFail($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['name','description','category_id','price']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produk','public');
        }
        $data['status_id'] = ProductStatus::where('name','pending')->first()->id ?? 1; // reset status ke pending jika diupdate
        $product->update($data);
        return redirect()->route('umkm.produk.index')->with('success','Produk berhasil diupdate, menunggu persetujuan admin.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkm = auth()->user()->umkm;
        $product = $umkm->products()->findOrFail($id);
        $product->delete();
        return redirect()->route('umkm.produk.index')->with('success','Produk berhasil dihapus.');
    }
}
