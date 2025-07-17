<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['umkm','category','status'])
            ->when($request->q, fn($q) => $q->where('name','like','%'.$request->q.'%'))
            ->when($request->kategori, fn($q) => $q->where('category_id', $request->kategori))
            ->when($request->status, fn($q) => $q->where('status_id', $request->status))
            ->latest()->paginate(12);
        $categories = Category::all();
        $statuses = ProductStatus::all();
        return view('admin.produk.index', compact('products','categories','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $product = Product::with('umkm')->findOrFail($id);
        $categories = Category::all();
        $statuses = ProductStatus::all();
        return view('admin.produk.edit', compact('product','categories','statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'status_id' => 'required|exists:product_statuses,id',
            'photo' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['name','description','category_id','price','status_id']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produk','public');
        }
        $product->update($data);
        return redirect()->route('admin.produk.index')->with('success','Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.produk.index')->with('success','Produk berhasil dihapus!');
    }

    public function approve($id)
    {
        $product = Product::findOrFail($id);
        $status = ProductStatus::where('name','approved')->first();
        if($status) $product->update(['status_id' => $status->id]);
        return redirect()->route('admin.produk.index')->with('success','Produk berhasil di-approve!');
    }

    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $status = ProductStatus::where('name','rejected')->first();
        if($status) $product->update(['status_id' => $status->id]);
        return redirect()->route('admin.produk.index')->with('success','Produk berhasil di-reject!');
    }
}