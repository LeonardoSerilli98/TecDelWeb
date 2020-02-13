<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentMethod;

class ProfileController extends Controller
{

    //raccoglie i dati necessari dal database e ritorna la view del profilo
    public function show($id)
    {
        $metodi = PaymentMethod::where('payment_methods.id_utente', '=', Auth::id())->get();
        return view('profile')->with('id', $id)->with('metodi', $metodi);
    }


    //permette di cambiare email o password al profilo attualmente autenticato
    public function update(Request $request, $id)
    {
        if($request->has('password')){
            $validatedData = $request->validate([
                'password' => 'min:6',
                'confirm_password' => 'required_with:password|same:password|min:6'
            ]);

            $user = Auth::user();

            $user->password = $request->password;
            $user->save();

        }elseif ($request->has('email')){
            $validatedData = $request->validate([
                'email' => 'required|unique:users|max:255',
            ]);

            $utente = Auth::user();
            $utente->update(['email' => $request->email]);


        }
        $metodi = PaymentMethod::where('payment_methods.id_utente', '=', $id)->get();
        return view('profile')->with('id', $id)->with('metodi', $metodi);
    }


}
