<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    //
    protected $fillable = [
        'subject', 'message', 'to_all', 'activated',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeWithUser($query, $userId)
    {
        $query->whereHas('users', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    public function setUserIdAttribute($userId)
    {
        $this->save();
        $user = User::find($userId);
        $this->users()->attach($user);
    }

}
