@extends('layouts.main')


@section('content')
                         <!-- ****** Welcome Post Area Start ****** -->
    <!-- RIPRENDI ASCOLTO -->

    <div class="slider">

        <div class="intestazione ">
            <strong> Riprendi l'Ascolto</strong>
        </div>

        <section class="welcome-post-sliders owl-carousel">

        @foreach($libriSlides['ascolto'] as $lib)

            <!-- Single Slide -->
                <div class="welcome-single-slide">
                    <div class = "slider-content">
                        <!-- Post Thumb -->
                        <img src="{{ asset('storage/'.$lib->img) }}" alt="">
                        <!-- trama --->
                        <div class="trama_slider"><h6 class="slider-text">{{$lib->trama}}</h6></div>
                    </div>
                    <!-- Overlay Text -->
                    <div class="project_title">
                        <div class="post-date-commnents d-flex">
                            <a href="{{URL::route('authors.show', $lib->id_autore)}}"> <h6 class="first_home_link">{{$lib->autore}}</h6></a>
                            <a href="{{URL::route('categories.show', $lib->id_categoria)}}"><h6>{{$lib->categoria}}</h6></a>
                        </div>
                        <a href="{{URL::route('books.show', $lib->id)}}">
                            <h5>{{$lib->titolo}}</h5>
                        </a>
                    </div>
                </div>


            @endforeach
        </section>
    </div>

    <!-- I PIU VOTATI -->


    <div class="slider">

        <div class="intestazione ">
            <strong> Più Votati </strong>
        </div>

        <section class="welcome-post-sliders owl-carousel">

            @foreach($libriSlides['voti'] as $lib)

            <!-- Single Slide -->
                <div class="welcome-single-slide">
                    <div class = "slider-content">
                        <!-- Post Thumb -->
                        <img src="{{ asset('storage/'.$lib->img) }}" alt="">
                        <!-- trama --->
                        <div class="trama_slider"><h6 class="slider-text">{{$lib->trama}}</h6></div>
                    </div>
                    <!-- Overlay Text -->
                    <div class="project_title">
                        <div class="post-date-commnents d-flex">
                            <a href="{{URL::route('authors.show', $lib->id_autore)}}"> <h6 class="first_home_link">{{$lib->autore}}</h6></a>
                            <a href="{{URL::route('categories.show', $lib->id_categoria)}}"><h6>{{$lib->categoria}}</h6></a>
                        </div>
                        <a href="{{URL::route('books.show', $lib->id)}}">
                            <h5>{{$lib->titolo}}</h5>
                        </a>
                    </div>
                </div>


            @endforeach
        </section>
    </div>

    <!-- I PIU ASCOLTATI -->

    <div class="slider">

        <div class="intestazione ">
            <strong> Piu Ascoltati </strong>
        </div>

        <section class="welcome-post-sliders owl-carousel">
            @foreach($libriSlides['ascolti'] as $lib)

            <!-- Single Slide -->
                <div class="welcome-single-slide">
                    <div class = "slider-content">
                        <!-- Post Thumb -->
                        <img src="{{ asset('storage/'.$lib->img) }}" alt="">
                        <!-- trama --->
                        <div class="trama_slider"><h6 class="slider-text">{{$lib->trama}}</h6></div>
                    </div>
                    <!-- Overlay Text -->
                    <div class="project_title">
                        <div class="post-date-commnents d-flex">
                            <a href="{{URL::route('authors.show', $lib->id_autore)}}"> <h6 class="first_home_link">{{$lib->autore}}</h6></a>
                            <a href="{{URL::route('categories.show', $lib->id_categoria)}}"><h6>{{$lib->categoria}}</h6></a>
                        </div>
                        <a href="{{URL::route('books.show', $lib->id)}}">
                            <h5>{{$lib->titolo}}</h5>
                        </a>
                    </div>
                </div>


            @endforeach
        </section>


    </div>
                         <!-- ****** Welcome Area End ****** -->

@endsection
