<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class AdminUmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Umkm::query();

        // Pencarian berdasarkan query 'q' (nama, deskripsi, alamat, telepon, dll.)
        if ($request->filled('q')) {
            $searchQuery = $request->q;
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('description', 'like', '%'.$searchQuery.'%')
                  ->orWhere('address', 'like', '%'.$searchQuery.'%')
                  ->orWhere('phone', 'like', '%'.$searchQuery.'%')
                  ->orWhere('whatsapp', 'like', '%'.$searchQuery.'%')
                  ->orWhere('instagram', 'like', '%'.$searchQuery.'%')
                  ->orWhere('tiktok', 'like', '%'.$searchQuery.'%')
                  ->orWhere('website', 'like', '%'.$searchQuery.'%');
            });
        }

        // Tambahkan filter kategori jika diperlukan, misalnya berdasarkan produk UMKM
        // Asumsi: Kita bisa memfilter UMKM berdasarkan kategori produk yang mereka miliki
        if ($request->filled('kategori')) {
            $categoryId = $request->kategori;
            $query->whereHas('products', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        $umkms = $query->latest()->paginate(10);
        $categories = Category::all();

        // Jika ini adalah permintaan AJAX, kembalikan hanya partial view tabel
        // Bagian ini mungkin tidak diperlukan jika tidak ada AJAX untuk tabel.
        // if ($request->ajax()) {
        //     return view('admin.umkm._partials.umkm_table', compact('umkms'))->render();
        // }

        return view('admin.umkm.index', compact('umkms', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('umkm_photos', 'public');
        }

        // Create a new User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->username . '@example.com', // Dummy email, consider unique user identifier
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'umkm', // Assign role as 'umkm'
        ]);

        // Create the UMKM entry linked to the new user
        Umkm::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'website' => $request->website,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        return view('admin.umkm.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|max:255|unique:users,username,' . $umkm->user_id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update User data
        $umkm->user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@example.com', // Keep dummy email or update if needed
        ]);

        if ($request->filled('password')) {
            $umkm->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Handle photo update
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($umkm->photo) {
                Storage::disk('public')->delete($umkm->photo);
            }
            $photoPath = $request->file('photo')->store('umkm_photos', 'public');
            $umkm->photo = $photoPath;
        } elseif ($request->input('remove_photo')) {
            // Remove photo if checkbox is checked
            if ($umkm->photo) {
                Storage::disk('public')->delete($umkm->photo);
            }
            $umkm->photo = null;
        }

        $umkm->update([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'website' => $request->website,
            // 'photo' is updated above
        ]);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        // Delete related user first
        if ($umkm->user) {
            $umkm->user->delete();
        }

        // Delete photo if exists
        if ($umkm->photo) {
            Storage::disk('public')->delete($umkm->photo);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus!');
    }
}