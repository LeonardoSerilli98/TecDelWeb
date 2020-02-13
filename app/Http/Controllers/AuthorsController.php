<?php

namespace App\Http\Controllers;

use App\Audiobook;
use App\Audiobook_has_Category;
use App\Author;
use App\Audiobook_has_Author;

class AuthorsController extends Controller
{
    //Ritorna la pagina degli autori, con questi ultimi in ordine alfabeico
    public function index()
    {
        $autori = Author::orderBy('autore')->get();
        return view('authors')->with('autori', $autori);
    }
    //ritorna i libri appartenenti ad un singolo autore
    public function show($id)
    {
        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->where('authors.id', '=', $id )
            ->orderBy('audiobooks.titolo')
            ->get();
        $currAuthor = Author::select('authors.autore')->where('authors.id', '=', $id)->get();

        return view('bookPerAuthor')->with('libri', $libri)->with('autore', $currAuthor);
    }


}
