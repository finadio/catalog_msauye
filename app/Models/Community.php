<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $guarded = [];

    public function members()
    {
        return $this->hasMany(CommunityMember::class);
    }

    public function posts()
    {
        return $this->hasMany(CommunityPost::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_members')
                    ->withPivot('role', 'status', 'join_reason')
                    ->withTimestamps();
    }

    public function getTagsAttribute()
    {
        // Return dummy tags for now or derive from data
        return [$this->type, $this->members_count . ' anggota'];
    }
}
