<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Audiobook;
use Illuminate\Http\Request;

class CollecionsController extends Controller
{
    //Ritorna la view delle collezzioni
    public function index()
    {
        $collezioni = Collection::orderBy('collezione', 'desc')->get();
        return view('collections')->with('collezione', $collezioni);
    }
    //Ritorna la view dei libri appartenenti a una collezione
    public function show($id)
    {
        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama' )
            ->join('collections', 'collections.id', '=', 'audiobooks.collezione')
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->where('audiobooks.collezione', '=', $id)
            ->orderBy('titolo', 'asc')
            ->get();

        $currCollection = Collection::select('collections.collezione')->where('collections.id', '=', $id)->get();

        return view('bookPerCollection')
            ->with('libri', $libri)
            ->with('collezione', $currCollection);
    }


}
