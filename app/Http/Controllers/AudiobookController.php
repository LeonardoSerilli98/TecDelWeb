<?php

namespace App\Http\Controllers;

use App\Audiobook;
use App\Bought;
use App\Chapter;
use App\Listening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Paginator;


class AudiobookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'asd';

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
    public function show(Request $request, $id)
    {

        $libro = Audiobook::select('audiobooks.id', 'audiobooks.titolo', 'audiobooks.num_upvote', 'audiobooks.num_vendite', 'audiobooks.prezzo', 'audiobooks.img', 'authors.autore', 'categories.categoria', 'audiobooks.trama', 'authors.id as id_autore', 'categories.id as id_categoria')
            ->join('authors', 'authors.id', '=', 'audiobooks.autore')
            ->join('categories', 'categories.id', '=', 'audiobooks.categoria')
            ->where('audiobooks.id', '=', $id)
            ->get();

        $msg = '';
        $showLinks = true;


        if(Auth::check()) {



           $hasBought = Bought::where('boughts.id_utente', '=', Auth::id())
               ->where('boughts.id_libro', '=', $id)->get();

           if (!($hasBought->isEmpty())) {

               $currChap = Listening::select('id_capitolo as id')
                   ->where('listenings.id_utente', '=', Auth::id())
                   ->where('listenings.id_libro', '=', $id)
                   ->get();

               if ($currChap->isEmpty() || $request->has('page')) {

                  $capitolo = Chapter::where('chapters.id_libro', '=', $id)->paginate(1);

                   if(!$currChap->isEmpty()) {
                       Listening::where('listenings.id_utente', '=', Auth::id())
                           ->where('listenings.id_libro', '=', $id)
                           ->forceDelete();
                   }

                   $item = new Listening();
                   $item->id_utente = Auth::id();
                   $item->id_libro = $id;
                   $item->id_capitolo = $capitolo[0]->id;
                   $item->save();


               } else {

                   //se nell'url non c'è la pagina fa questo, senno  $capitolo = Chapter::where('chapters.id_libro', '=', $id)->paginate(1);

                   $currentPage = Chapter::select('num_capitolo')->find($currChap[0]->id)->num_capitolo;
                   $capitolo = Chapter::where('chapters.id_libro', '=', $id)->paginate(1, ['*'], 'page', $currentPage);
               }

           } else {

                $capitolo = Chapter::where('chapters.id_libro', '=', $id)->where('chapters.num_capitolo', '=', 1)->get();
                $msg = 'devi comprare il libro per ascolare altri capitoli';
                $showLinks = false;
           }

       }else{

               $capitolo = Chapter::where('chapters.id_libro', '=', $id)->where('chapters.num_capitolo', '=', 1)->get();
               $msg = 'devi avere un profilo per comprare il libro e accedere ad altri capitoli';
               $showLinks = false;

       }



        return view('book')->with('libro', $libro)->with('capitolo', $capitolo)->with('msg' , $msg)->with('showLinks', $showLinks);
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
        //
    }
}
