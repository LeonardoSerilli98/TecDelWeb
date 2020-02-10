@extends('layouts.main')


@section('content')
    <section class="archive-area ">
        <div class="container">
            <div class="row">
                @if($success)
                <!-- Single Post -->
                    @foreach($libri as $lib)
                        <div class="single-wishlist">
                            <div class="single-post wow fadeInUp post-wishlist" data-wow-delay="0.1s">
                                <!-- Post Thumb -->
                                <div class="post-thumb results-image">
                                    <img class="wishimage" src="{{asset('storage/'.$lib->img)}}" alt="">
                                </div>
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
                @else
                    <div class="no-results">
                        <h1 >La ricerca non ha prodotto risultati</h1>
                    </div>
                @endif

            </div>
        </div>

    </section>
@endsection
