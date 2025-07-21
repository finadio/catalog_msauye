<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Filter berdasarkan tipe artikel jika parameter 'tipe' ada
        if ($request->filled('tipe')) {
            $query->where('type', $request->tipe);
        }

        // Pencarian berdasarkan query 'q' (judul atau konten)
        if ($request->filled('q')) {
            $searchQuery = $request->q;
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%'.$searchQuery.'%')
                  ->orWhere('content', 'like', '%'.$searchQuery.'%');
            });
        }

        $articles = $query->latest()->paginate(10);

        // Ambil semua tipe artikel unik untuk dropdown filter
        $articleTypes = Article::select('type')->distinct()->get()->pluck('type');

        return view('admin.artikel.index', compact('articles', 'articleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article_images', 'public');
        }

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'type' => $request->type,
            'content' => $request->content,
            'image' => $imagePath,
            'published_at' => now(), // Set published_at to current time
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $artikel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($artikel->image) {
                Storage::disk('public')->delete($artikel->image);
            }
            $imagePath = $request->file('image')->store('article_images', 'public');
            $artikel->image = $imagePath;
        } elseif ($request->input('remove_image')) {
            // Remove image if checkbox is checked
            if ($artikel->image) {
                Storage::disk('public')->delete($artikel->image);
            }
            $artikel->image = null;
        }

        $artikel->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'type' => $request->type,
            'content' => $request->content,
            // 'image' is updated above
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $artikel)
    {
        // Delete image if exists
        if ($artikel->image) {
            Storage::disk('public')->delete($artikel->image);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}