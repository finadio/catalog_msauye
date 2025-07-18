<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User; // Tambahkan ini untuk model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk hashing password
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk upload/hapus foto

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
        // Ini adalah kode yang benar untuk menampilkan form create UMKM
        return view('admin.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users,email',
            'user_password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255', // Tambahkan validasi ini
            'website' => 'nullable|url|max:255',   // Tambahkan validasi ini (nullable|url)
            'photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Buat user baru dengan role 'umkm'
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => Hash::make($request->user_password),
            'role' => 'umkm',
            'email_verified_at' => now(), // Verifikasi email otomatis untuk UMKM yang ditambahkan admin
        ]);

        // Handle upload foto UMKM
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('umkm','public');
        }

        // Buat entri UMKM dan tautkan dengan user yang baru dibuat
        $umkm = new Umkm($request->only(['name', 'description', 'address', 'phone', 'whatsapp', 'instagram', 'tiktok', 'website'])); // Tambahkan 'tiktok' dan 'website'
        $umkm->user_id = $user->id; // Tautkan ke user
        $umkm->photo = $photoPath;
        $umkm->save();

        return redirect()->route('admin.umkm.index')->with('success','UMKM baru berhasil ditambahkan!');
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
            'tiktok' => 'nullable|string|max:255', // Tambahkan validasi ini
            'website' => 'nullable|url|max:255',   // Tambahkan validasi ini
            'photo' => 'nullable|image|max:2048',
        ]);

        // Tambahkan 'tiktok' dan 'website' ke array data yang akan disimpan
        $data = $request->only(['name','description','address','phone','whatsapp','instagram', 'tiktok', 'website']);
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($umkm->photo) {
                Storage::disk('public')->delete($umkm->photo);
            }
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
        // Hapus user terkait UMKM jika ada
        if ($umkm->user) {
            $umkm->user->delete();
        }
        // Hapus foto UMKM jika ada
        if ($umkm->photo) {
            Storage::disk('public')->delete($umkm->photo);
        }
        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success','UMKM berhasil dihapus!');
    }
}