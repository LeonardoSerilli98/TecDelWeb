<?php

namespace App\Http\Controllers;

use App\Bought;
use App\Cart;
use Illuminate\Http\Request;
use App\PaymentMethod;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;


class PaymentMethodController extends Controller
{
    //ritorna la view di pagamento effettuato con il relativo esito tramite il redirect del metodo pay
    public function index()
    {
        return view('payed');
    }
    //si occupa di salvare i nuovi metodi di pagamento
    public function store(Request $request)

    {
        $metodo = new PaymentMethod();
        $metodo->num_carta = $request->num_carta;
        $metodo->nome_titolare = $request->nome_titolare;
        $metodo->id_utente = Auth::id();
        $metodo->save();
        $metodi = PaymentMethod::where('payment_methods.id_utente', '=', Auth::id())->get();
        return view('profile')->with('id', Auth::id())->with('metodi', $metodi);
    }
//per la rimozione dei metodi di pagamento
    public function destroy($id)
    {
        $metodo = PaymentMethod::find($id);
        $metodo->forceDelete();

        $metodi = PaymentMethod::where('payment_methods.id_utente', '=', Auth::id())->get();
        return view('profile')->with('id', Auth::id())->with('metodi', $metodi);
    }

    //si occupa dell'acquisto di un libro e ei trigger che genera
    public function payment($acquisti){

        $acquisti = json_decode($acquisti, true);

        foreach ($acquisti as  $libro){

            //Aggiunta dei libri comprati a quelli posseduti
            $newItem = new Bought();
            $newItem->id_utente = Auth::id();
            $newItem->id_libro = $libro['id'];
            $newItem->save();

            //rimozione dei libri comprati a quelli nella whishlist
            Wishlist::where('wishlists.id_utente', '=', Auth::id())
                ->where('wishlists.id_libro', '=', $libro['id'])
                ->delete();

            //rimozione dei libri comprati a quelli nella whishlist
            Cart::where('carts.id_utente', '=', Auth::id())
                ->where('carts.id_libro', '=', $libro['id'])
                ->delete();

        }
    }

    //si occupa della verifica che il pagamento vada a buon fine restituendone l'esito ramite il redirect alla view "payed"
    public function pay(Request $request)
    {

        $success = true;

        if(($request->has('pay_method'))){

            if($request->pay_method == 0){
                $success = false;
                return redirect('/payed')->with('todo', 'non hai selezionato alcun metodo di pagameto, ')->with('successo', $success);
            }

            self::payment($request->libri);

            return redirect('/payed')->with('todo', 'Il pagamento è stato portato a termine con successo, ')->with('successo', $success);

        }


        if($request->has('save_payment')){
            $newItem = new PaymentMethod();
            $newItem->id_utente = Auth::id();
            $newItem->num_carta = $request->card_num;
            $newItem->nome_titolare = $request->nome_titolare;
            $newItem->save();
        }
        self::payment($request->libri);
        return redirect('/payed')->with('todo', 'Il pagamento è stato portato a termine con successo, ');
    }


}
