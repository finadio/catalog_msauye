<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityPost;
use App\Models\CommunityComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function storePost(Request $request, $communityId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $community = Community::findOrFail($communityId);
        
        // Check if user is a member
        if (!$community->users()->where('users.id', Auth::id())->exists()) {
            return back()->with('error', 'Anda harus menjadi anggota untuk memposting.');
        }

        CommunityPost::create([
            'community_id' => $communityId,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Diskusi berhasil ditambahkan.');
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post = CommunityPost::findOrFail($postId);
        $community = $post->community;

        // Check if user is a member
        if (!$community->users()->where('users.id', Auth::id())->exists()) {
            return back()->with('error', 'Anda harus menjadi anggota untuk berkomentar.');
        }

        CommunityComment::create([
            'community_post_id' => $postId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
