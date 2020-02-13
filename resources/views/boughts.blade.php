@extends('layouts.main')


@section('content')
    <!-- area nome pagina-->
    <div class="breadcumb-area breadcumb-area2" >
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>My Books</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">  <a href="">Libreria Personale</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- fine area nome pagina-->

    @if($auth)
        @if($hasLibri)
             <!-- contenuto-->
            <section class="archive-area section_padding_80">
            <div class="container">
                <div class="row">
                    <!-- Single Post -->
                    @foreach($libri as $lib)
                        <div class="single-wishlist">
                            <div class="single-post wow fadeInUp post-wishlist" data-wow-delay="0.1s">
                                <!-- Post Thumb -->
                                <a href="{{URL::route('books.show', $lib->id)}}" style="">
                                    <div class="post-thumb results-image">
                                    <img class="wishimage" src="{{asset('storage/'.$lib->img)}}" alt="">
                                   </div>
                                </a>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="{{url('authors/'.$lib->id_autore)}}">{{$lib->autore}}</a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="{{url('categories/'.$lib->id_categoria)}}">{{$lib->categoria}}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{URL::route('books.show', $lib->id)}}" style="">
                                        <h4 class="post-headline">{{$lib->titolo}}</h4>
                                    </a>
                                    <div class="descrizione-wishlist">
                                        <h6>{{$lib->trama}}</h6>
                                    </div>
                                    <div class="post-comment-share-area1 d-flex">
                                        <div class="post-favourite pr-2">
                                            <i class="fas fa-thumbs-up"></i> {{$lib->num_upvote}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
        @else
            <div class="no-results">
                <h1 > Non hai ancora acquistato alcun titolo </h1>
            </div>
        @endif

    @else
        <div class="no-results">
            <h1 >Effettua il log in per accedere ai tuoi acquisti </h1>
        </div>
    @endif

@endsection
