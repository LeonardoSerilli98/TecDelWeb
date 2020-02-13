@extends('layouts.main')


@section('content')

        <div class="breadcumb-area breadcumb-area1">
            @foreach($autore as $aut)
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="bradcumb-title text-center">
                            <h2>{{$aut->autore}}</h2>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
        @foreach($autore as $aut)
        <div class="breadcumb-nav">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
                                <li class="breadcrumb-item active" aria-current="page">  <a href="/authors"> Autori</a> </li>

                                    <li class="breadcrumb-item active" aria-current="page"><a href="">  {{$aut->autore}}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
     @endforeach


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

                                <a href="{{URL::route('books.show', $lib->id)}}">
                                    <h4 class="post-headline">{{$lib->titolo}}</h4>
                                </a>
                                <div class="prezzo1">
                                    <h5>{{$lib->prezzo}}€</h5>
                                </div>
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
@endsection
