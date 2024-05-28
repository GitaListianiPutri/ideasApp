<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        // kita tidak perlu membuat array assosiatif, cukup menggunakan compact saja
        return view('ideas.show', compact('idea'));
    }
    public function store()
    {
        $validate = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);
        // menggunakan method statis pada sebuah model yaitu create
         Idea::create($validate);
        return redirect()->route('dashboard')->with('success', 'Idea berhasil dibuat!');
    }
    public function destroy(Idea $idea)
    {
        // menggunakan pengikatan model rute yang lebih sederhana
        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea berhasil dihapus!');
    }
    public function edit(Idea $idea)
    {
        // memuat variabel editing dan selanjutnya diteruskan ke view
        $editing = true;
        // kita tidak perlu membuat array assosiatif, cukup menggunakan compact saja
        return view('ideas.show', compact('idea', 'editing'));
    }
    public function update(Idea $idea)
    {
        $validate = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->update($validate);
        
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea berhasil diupdate!');
    }
}
