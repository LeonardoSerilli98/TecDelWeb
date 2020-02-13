@extends('layouts.main')


@section('content')
    <div class="no-results">
        <h1>{{session('todo')}} ritorna alla

            @if( session('successo') )
                <a href="/">Home</a>
            @else
             <a href="/cart">carrello</a>

                @endif
        </h1>

    </div>
    @endsection
