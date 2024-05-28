<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    //  yang tidak bisa diisi oleh user
    // jadi tujuan penggunaan guarded itu adalah untuk menghemat waktu dalam mendefinisikan setiap kolom
    // ketika memiliki banyak kolom pada databse yang fillabe
    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];

    // yang bisa diisi oleh user
    protected $fillable = [
        'content',
        'like'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
