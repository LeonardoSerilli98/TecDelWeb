<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Audiobook;
use Illuminate\Support\Facades\Auth;


class BoughtController extends Controller
{
    //ritorna la view deila libreria personale contenente tutti gli acquisti effettuati

    public function index()
    {
        $autenticato =  Auth::check();
        $hasLibri = true;
        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->join('boughts', 'boughts.id_libro', '=', 'audiobooks.id')
            ->where('boughts.id_utente', '=', Auth::id())
            ->orderBy('titolo', 'asc')
            ->get();

        if($libri->isEmpty()){
            $hasLibri = false;
        }

        return view('boughts')->with('libri', $libri)->with('auth', $autenticato)->with('hasLibri', $hasLibri);
    }


}
