<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Contact::query();

        // Search
        if ($request->filled('q')) {
            $searchQuery = $request->q;
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%'.$searchQuery.'%')
                  ->orWhere('email', 'like', '%'.$searchQuery.'%')
                  ->orWhere('subject', 'like', '%'.$searchQuery.'%')
                  ->orWhere('message', 'like', '%'.$searchQuery.'%');
            });
        }

        // Filter status terbaca
        if ($request->filled('is_read')) {
            $query->where('is_read', $request->is_read);
        }

        $contacts = $query->latest()->paginate(15)->appends($request->all());
        return view('admin.contact.index', compact('contacts'));
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
        $contact = Contact::findOrFail($id);
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success','Pesan berhasil dihapus!');
    }

    // Tambahkan method untuk menandai pesan sebagai terbaca
    public function markAsRead($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->is_read = true;
        $contact->save();
        return redirect()->back()->with('success', 'Pesan ditandai sebagai sudah dibaca.');
    }
}
