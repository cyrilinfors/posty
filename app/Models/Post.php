<?php

namespace App\Models;
use App\Models\User;
use App\Models\like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likeBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
    public function ownBy(User $user)
    {
        return $user->id == $this->user_id;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
