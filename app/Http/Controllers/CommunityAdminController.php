<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityAdminController extends Controller
{
    public function index($id)
    {
        $community = Community::findOrFail($id);
        
        // Check if user is admin of this community
        $membership = $community->members()
            ->where('user_id', auth()->id())
            ->where('role', 'admin')
            ->where('status', 'approved')
            ->first();
            
        if (!$membership) {
            abort(403, 'Anda bukan admin dari komunitas ini.');
        }
        
        // Get pending members
        $pendingMembers = $community->members()
            ->where('status', 'pending')
            ->with('user')
            ->get();
            
        // Get active members
        $activeMembers = $community->members()
            ->where('status', 'approved')
            ->with('user')
            ->get();
            
        return view('community_admin.index', compact('community', 'pendingMembers', 'activeMembers'));
    }

    public function approveMember($communityId, $userId)
    {
        $community = Community::findOrFail($communityId);
        
        // Check authorization
        $isAdmin = $community->members()
            ->where('user_id', auth()->id())
            ->where('role', 'admin')
            ->where('status', 'approved')
            ->exists();
            
        if (!$isAdmin) {
            abort(403);
        }

        $member = $community->members()->where('user_id', $userId)->firstOrFail();
        $member->update(['status' => 'approved']);

        return back()->with('success', 'Anggota berhasil disetujui.');
    }

    public function rejectMember($communityId, $userId)
    {
        $community = Community::findOrFail($communityId);
        
        // Check authorization
        $isAdmin = $community->members()
            ->where('user_id', auth()->id())
            ->where('role', 'admin')
            ->where('status', 'approved')
            ->exists();
            
        if (!$isAdmin) {
            abort(403);
        }

        $member = $community->members()->where('user_id', $userId)->firstOrFail();
        $member->update(['status' => 'rejected']);

        return back()->with('success', 'Anggota berhasil ditolak.');
    }
}
