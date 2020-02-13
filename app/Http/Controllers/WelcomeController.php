<?php

namespace App\Http\Controllers;

use App\Audiobook;
use App\Author;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {
        $riprendiAscolto =  Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->take(5)
            ->get();
        //aggiungi il where per la tabella 'riprendiAscolto'

        $piuVotati = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->orderBy('num_upvote', 'DESC')
            ->take(5)
            ->get();

        $piùAscolati = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->orderBy('num_vendite', 'DESC')
            ->take(5)
            ->get();

        $libriSlides = array( "ascolto" => $riprendiAscolto, "voti" => $piuVotati, "ascolti" => $piùAscolati);

        return view('hello')->with('libriSlides', $libriSlides);
    }

  
}
