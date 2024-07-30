<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'idea_id',
        'content'
    ];

    // define relationship
    public function user(){
        // hubungan one to one
        return $this->belongsTo(User::class);
    }
}
