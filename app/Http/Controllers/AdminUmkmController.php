<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class AdminUmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $umkms = Umkm::when($request->q, function($q) use ($request) {
            $q->where('name', 'like', '%'.$request->q.'%');
        })->latest()->paginate(10);
        return view('admin.umkm.index', compact('umkms'));
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
    public function show($id)
    {
        $umkm = Umkm::with('products')->findOrFail($id);
        return view('admin.umkm.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.umkm.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'whatsapp' => 'nullable',
            'instagram' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['name','description','address','phone','whatsapp','instagram']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('umkm','public');
        }
        $umkm->update($data);
        return redirect()->route('admin.umkm.index')->with('success','Data UMKM berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success','UMKM berhasil dihapus!');
    }
}
