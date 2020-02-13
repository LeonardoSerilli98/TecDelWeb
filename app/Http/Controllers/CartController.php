<?php

namespace App\Http\Controllers;

use App\Audiobook;
use App\PaymentMethod;
use App\Bought;
use Illuminate\Http\Request;
use App\Cart;
use \Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Ritorna la view del carrello
    public function index()
    {
        $autenticato =  Auth::check();
        $hasCart = true;
        $libri = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'authors.id as id_autore', 'categories.id as id_categoria' )
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->join('carts', 'carts.id_libro', '=', 'audiobooks.id')
            ->where('carts.id_utente', '=', Auth::id())
            ->orderBy('titolo', 'asc')
            ->get();

        $tot = 0;
        foreach ($libri as $lib){
            $tot += $lib->prezzo;

        }

        if($libri->isEmpty()){
            $hasCart = false;
        }

        $payMethods = PaymentMethod::where('payment_methods.id_utente', '=', Auth::id())->get();


        return view('cart')
            ->with('libri', $libri)
            ->with('auth', $autenticato)
            ->with('hasCart', $hasCart)
            ->with('pay_met', $payMethods)
            ->with('tot', $tot);
    }

    //si occupa di salvare i nuovi acquisti nel carrello
    public function store(Request $request)
    {

        if(!(Auth::check())){
            return view('nonAuenticato');
        }

       $hasAdded = Cart::where('carts.id_libro', '=', $request->id_libro)->where('carts.id_utente', '=', Auth::id())->get();
       $youHave = Bought::where('boughts.id_libro', '=', $request->id_libro)->where('boughts.id_utente', '=', Auth::id())->get();


        if($hasAdded->isEmpty() && $youHave->isEmpty()) {
            $newItem = new Cart();
            $newItem->id_utente = Auth::id();
            $newItem->id_libro = $request->id_libro;
            $newItem->save();
        }

        return redirect()->back();

    }


}
