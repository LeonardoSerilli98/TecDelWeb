<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentMethod;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metodi = PaymentMethod::where('payment_methods.id_utente', '=', Auth::id())->get();
        return view('profile')->with('id', $id)->with('metodi', $metodi);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
