<?php

namespace App\Http\Controllers;

use App\Audiobook;

use App\Category_has_Author;

use App\Category;

class CategoriesController extends Controller
{
    //Ritorna la view Categorie con tutte le categorie
    public function index()
    {
         $categorie = Category::orderBy('categoria', 'asc')->get();
         return view('categories')->with('categorie', $categorie);
    }

    //Mostra tutti i libri appartenenti a una singola categoria
    public function show($id)
    {
        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->where('categories.id', '=', $id )
            ->orderBy('titolo', 'asc')
            ->get();
        $currCategory = Category::select('categories.categoria')->where('categories.id', '=', $id)->get();

        return view('bookPerCategory')
            ->with('libri', $libri)
            ->with('categoria', $currCategory);
    }

}
