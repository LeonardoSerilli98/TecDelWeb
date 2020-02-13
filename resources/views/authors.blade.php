@extends('layouts.main')


@section('content')
    <!-- area nome pagina-->
    <div class="breadcumb-area breadcumb-area1">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Autori</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> <a href="/"> Autori</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- fine area nome pagina-->

    <!-- contenuto -->


        <section class="categories_area clearfix" id="about">
        <div class="container d-flex flex-row flex-wrap col-12 justify-content-md-center">
            <!-- da generare automaticamente -->
            @foreach($autori as $aut)
                <div class="categoria">

                    <div class="autore wow fadeInUp" data-wow-delay=".3s">
                        <a href="/authors/{{$aut->id}}">
                        <img src="{{ asset('storage/'.$aut->img) }}" alt="">
                    </a>
                        <div class="autore-text">

                            <a href="/authors/{{$aut->id}}">
                                <h5>{{$aut->autore}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- fine contenuto -->


@endsection

