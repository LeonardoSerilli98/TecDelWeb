@extends('layouts.main')


@section('content')
    <section class="archive-area section_padding_80_book">
        <div class="container">
            <div class="row">
            @foreach($libro as $lib)
                <!-- Single Post -->
                <div class="single-book">
                    <div class=" book_content wow fadeInUp post-wishlist" data-wow-delay="0.1s">

                        <!-- Post Thumb -->
                        <div class="post-thumb book-image">
                            <img class="bookimage" src="{{asset('storage/'.$lib->img)}}" alt="">
                        </div>

                        <!-- Post Content -->
                        <div class="post-content">
                        <div class="post-content">
                            <div class="post-meta d-flex">
                                <div class="post-author-date-area d-flex">
                                    <!-- Post Author -->
                                    <div class="post-author">
                                        <a href="#">{{$lib->autore}}</a>
                                    </div>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="#">{{$lib->categoria}}</a>
                                    </div>
                                </div>
                            </div>

                            <a href="#" style="">
                                <h4 class="post-headline">{{$lib->titolo}}</h4>
                            </a>

                            <div class="descrizione-wishlist">
                                <h6>{{$lib->trama}}</h6>
                            </div>

                            <div class="prezzo">
                                <h5>{{$lib->prezzo}}€</h5>
                            </div>


                            <div class="audio_player">


                                        @foreach($capitolo as $cap)
                                            <h5> Capitolo: {{$cap->num_capitolo}} </h5>

                                            <audio controls>

                                                <source class="chapter-audio" src="{{asset('storage/'.$cap->mp3)}}" type="audio/mp3">

                                            </audio>

                                            <h5>{{$msg}}</h5>

                                        @endforeach

                                        @if($showLinks)
                                            {{ $capitolo->links() }}
                                            @endif



                            </div>



                        </div>





                            <div class="post-comment-share-area d-flex">
                                <!-- WISHLIST -->
                                <div class="post-share">
                                    <form method="POST" action="http://127.0.0.1:8000/wishlist" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_libro" value="{{ $lib->id }}">
                                        <button class="bottone" type="submit" ><i class="fas fa-star"></i></button>
                                    </form>
                                </div>
                                <!-- UPVOTES -->
                                <div class="post-share">
                                    <form method="POST" action="http://127.0.0.1:8000/rating" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_libro" value="{{ $lib->id }}">
                                        <button class="bottone bottone_centrale" type="submit" >{{$lib->num_upvote}} <i class="fas fa-thumbs-up"></i></button>
                                    </form>
                                </div>
                                <!--CART -->
                                <div class="post-share">
                                    <form method="POST" action="http://127.0.0.1:8000/cart" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_libro" value="{{ $lib->id}}">
                                        <button class="bottone" type="submit" >{{$lib->num_vendite}} <i class="fas fa-shopping-cart pr-3" aria-hidden="true"></i></button>
                                    </form>
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



