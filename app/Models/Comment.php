<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    //Instances
    protected $guarded = [];

    //Methods
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
