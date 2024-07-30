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

        // menyimpan id user yang sedang login
        $validate['user_id'] = auth()->id();

        // menggunakan method statis pada sebuah model yaitu create
         Idea::create($validate);
        return redirect()->route('dashboard')->with('success', 'Idea berhasil dibuat!');
    }
    public function destroy(Idea $idea)
    {

        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        // menggunakan pengikatan model rute yang lebih sederhana
        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea berhasil dihapus!');
    }
    public function edit(Idea $idea)
    {
        // jika user yang sedang login bukan user yang membuat idea maka tidak bisa edit
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        // memuat variabel editing dan selanjutnya diteruskan ke view
        $editing = true;
        // kita tidak perlu membuat array assosiatif, cukup menggunakan compact saja
        return view('ideas.show', compact('idea', 'editing'));
    }
    public function update(Idea $idea)
    {
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $validate = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->update($validate);
        
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea berhasil diupdate!');
    }
}
