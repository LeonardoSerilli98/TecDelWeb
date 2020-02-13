<?php

namespace App\Http\Controllers;

use App\Audiobook_has_Author;
use App\Audiobook_has_Category;
use Illuminate\Http\Request;
use App\Audiobook;

class SearchController extends Controller
{

    public function getSearch(Request $search){

        $success = true;
        $search->q = str_replace("+", ' ', $search->q );
        $search->q = str_replace("*", '\*', $search->q );

        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->orWhere('categories.categoria', 'REGEXP', $search->q)
            ->orWhere('audiobooks.titolo', 'REGEXP', $search->q)
            ->orWhere('authors.autore', 'REGEXP', $search->q)
            ->orderBy('titolo', 'asc')
            ->get();
        if($libri->isEmpty()){
            $success = false;
        }
        return view('results')->with('libri', $libri)->with('success', $success);

    }

}
