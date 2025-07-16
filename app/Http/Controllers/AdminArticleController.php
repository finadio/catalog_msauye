<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.artikel.index', compact('articles'));
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
            'title' => 'required',
            'content' => 'required',
            'type' => 'required|in:edukasi,berita',
            'photo' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['title','content','type']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artikel','public');
        }
        Article::create($data);
        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan!');
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
        $article = Article::findOrFail($id);
        return view('admin.artikel.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required|in:edukasi,berita',
            'photo' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['title','content','type']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artikel','public');
        }
        $article->update($data);
        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil dihapus!');
    }
}
