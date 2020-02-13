<?php

namespace App\Http\Controllers;

use App\Bought;
use App\Cart;
use App\Wishlist;
use Illuminate\Http\Request;
use App\Audiobook;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    //prende dal database i libri nella wishilist dell'utente autenticato
    public function index()
    {
        $autenticato = Auth::check();
        $hasWishlist = true;
        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->join('wishlists', 'wishlists.id_libro', '=', 'audiobooks.id')
            ->where('wishlists.id_utente', '=', Auth::id())
            ->orderBy('titolo', 'asc')
            ->get();

        if($libri->isEmpty()){
            $hasWishlist = false;
        }

        return view('wishlist')->with('libri', $libri)->with('auth', $autenticato)->with('hasWishlist', $hasWishlist);
    }


    //aggiunge un libro alla wishlist dell'utente autenticato
    public function store(Request $request)
    {

        if(!(Auth::check())){
            return view('nonAuenticato');
        }

        $hasAdded = Wishlist::where('wishlists.id_libro', '=', $request->id_libro)->where('wishlists.id_utente', '=', Auth::id())->get();
        $youHave = Bought::where('boughts.id_libro', '=', $request->id_libro)->where('boughts.id_utente', '=', Auth::id())->get();


        if($hasAdded->isEmpty() && $youHave->isEmpty()) {
            $newItem = new Wishlist();
            $newItem->id_utente = Auth::id();
            $newItem->id_libro = $request->id_libro;
            $newItem->save();
        }
        return redirect()->back();

    }

}
