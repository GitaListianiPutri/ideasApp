<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'DESC');

        // jika user menggunakan search
        // jika terdapat nilai pencarian dengan database
        // fungsi has yang memeriksa apakah argumen/parameter url ada/tidak
        // menggunakan methode where
        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        // all: dapatkan semua model dari database
        return view('dashboard', [
            'ideas' => $ideas->paginate(5)
        ]);
    }
}
