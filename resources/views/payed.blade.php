@extends('layouts.main')


@section('content')
    <div class="no-results">
        <h1>{{session('todo')}} ritorna alla <a href="/">Home</a> </h1>
    </div>
    @endsection
