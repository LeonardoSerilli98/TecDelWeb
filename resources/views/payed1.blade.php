@extends('layouts.main')


@section('content')
    <div class="no-results">
        <h1>{{session('todo')}} ritorna al <a href="/cart">Carrello</a> </h1>
    </div>
    @endsection
