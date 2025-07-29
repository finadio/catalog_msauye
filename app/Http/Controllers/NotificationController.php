<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display notifications for admin
     */
    public function adminIndex(Request $request)
    {
        $query = Auth::user()->notifications();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(data, '$.title') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(data, '$.message') LIKE ?", ["%{$search}%"]);
            });
        }

        // Filter by read status
        if ($request->filled('status')) {
            if ($request->get('status') === 'unread') {
                $query->whereNull('read_at');
            } elseif ($request->get('status') === 'read') {
                $query->whereNotNull('read_at');
            }
        }

        // Filter by notification type
        if ($request->filled('type')) {
            $query->where('type', 'LIKE', '%' . $request->get('type') . '%');
        }

        $notifications = $query->orderBy('created_at', 'desc')
            ->paginate(5) // Ubah ke 5 untuk memaksa pagination muncul
            ->appends($request->query());
        
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Display notifications for UMKM
     */
    public function umkmIndex(Request $request)
    {
        $query = Auth::user()->notifications();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(data, '$.title') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(data, '$.message') LIKE ?", ["%{$search}%"]);
            });
        }

        // Filter by read status
        if ($request->filled('status')) {
            if ($request->get('status') === 'unread') {
                $query->whereNull('read_at');
            } elseif ($request->get('status') === 'read') {
                $query->whereNotNull('read_at');
            }
        }

        // Filter by notification type
        if ($request->filled('type')) {
            $query->where('type', 'LIKE', '%' . $request->get('type') . '%');
        }

        $notifications = $query->orderBy('created_at', 'desc')
            ->paginate(5) // Ubah ke 5 untuk memaksa pagination muncul
            ->appends($request->query());
        
        return view('umkm.notifications.index', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        
        if ($notification) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notifikasi telah ditandai sebagai sudah dibaca');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai sudah dibaca');
    }

    /**
     * Get unread notifications count
     */
    public function getUnreadCount()
    {
        return response()->json([
            'count' => Auth::user()->unreadNotifications->count()
        ]);
    }

    /**
     * Delete notification
     */
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        
        if ($notification) {
            $notification->delete();
        }

        return back()->with('success', 'Notifikasi telah dihapus');
    }
}
