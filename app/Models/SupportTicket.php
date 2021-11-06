<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class SupportTicket extends Model
{
    use HasFactory;

    //Methods
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
