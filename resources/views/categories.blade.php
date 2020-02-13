@extends('layouts.main')


@section('content')
    <!-- area nome pagina-->
    <div class="breadcumb-area breadcumb-area1"  >
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Categorie</h2>
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
                            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i><a href="/">  Home </a></li>
                           <li class="breadcrumb-item active" aria-current="page">  <a href="">Categorie</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- fine area nome pagina-->

    <!-- contenuto -->
    <section class="categories1_area clearfix" id="about">
        <div class="container d-flex flex-row flex-wrap col-12 justify-content-md-center">
            <!-- da generare automaticamente -->
            @foreach($categorie as $cat)
                <div class="categoria1">
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('storage/'.$cat->img) }}" alt="">
                        <div class="catagory-title">
                            <a href="{{url('categories/'.$cat->id)}}">
                                <h5>{{$cat->categoria}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- fine contenuto -->

@endsection
