<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

class upvoteController extends Controller
{

    public function store(Request $request)
    {
        if(!(Auth::check())){
            return view('nonAuenticato');
        }

        $hasAdded = Rating::where('ratings.id_libro', '=', $request->id_libro)->where('ratings.id_utente', '=', Auth::id())->get();

        if($hasAdded->isEmpty()) {
            $newItem = new Rating();
            $newItem->id_utente = Auth::id();
            $newItem->id_libro = $request->id_libro;
            $newItem->save();
        }

        return redirect()->back();
    }

}
