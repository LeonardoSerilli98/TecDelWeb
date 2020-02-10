<?php

namespace App\Http\Controllers;

use App\Bought;
use App\Cart;
use App\Audiobook;
use Illuminate\Http\Request;
use App\PaymentMethod;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;


class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payed');
    }

    public function index1()
    {
        return view('payed1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metodo = PaymentMethod::find($id);
        $metodo->forceDelete();

        $metodi = PaymentMethod::where('payment_methods.id_utente', '=', Auth::id())->get();
        return view('profile')->with('id', Auth::id())->with('metodi', $metodi);
    }

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

    public function pay(Request $request)
    {

        if(($request->has('pay_method'))){

            if($request->pay_method == 0)
                return redirect('/payed1')->with('todo', 'non hai selezionato alcun metodo di pagameto, ');

            self::payment($request->libri);
            return redirect('/payed')->with('todo', 'Il pagamento è stato portato a termine con successo, ');

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
