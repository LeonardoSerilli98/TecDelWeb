@extends('layouts.main')


@section('content')

    <!-- area nome pagina-->
    <div class="breadcumb-area breadcumb-area1">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Carrello</h2>
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
                            <li class="breadcrumb-item active" aria-current="page">  <a href="">Carrello</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- fine area nome pagina-->

    @if($auth)
        @if($hasCart)
            <div class="carrello">

                <div class="cart-container archive-area section_padding_80" >
                        <!-- Single Post -->
                            @foreach($libri as $lib)
                                <div class="single-cart-item">
                                    <div class="single-post wow fadeInUp post-wishlist" data-wow-delay="0.1s">
                                        <!-- Post Thumb -->
                                        <div class="post-thumb results-image">
                                            <img class="cartimage" src="{{asset('storage/'.$lib->img)}}" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{URL::route('books.show', $lib->id)}}" style="">
                                                <h4 class="post-headline">{{$lib->titolo}}</h4>

                                            </a>


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

                                            <div class="prezzo">
                                                <h5>{{$lib->prezzo}}€</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                      </div>


                <div class="acquista">

                    <form method="POST" action="pay" enctype="multipart/form-data" class="form1" >

                        @csrf
                        <div class="left_payment">
                        <div class="pay_form1">
                            <h6> seleziona un metodo di pagamento...</h6>
                            <input name="libri" type="hidden" value="{{ $libri }}" >
                            <select name="pay_method">

                                <option value="0">metodo di pagamento: </option>

                                @foreach($pay_met as $pay)
                                    <option value="{{$pay->id}}">carta: {{$pay->num_carta}}</option>
                                @endforeach

                            </select>

                            <input type="submit" value="paga con il metodo selezionato">
                        </div>
                            <div class="totale"> <h1>TOT: {{$tot}}€</h1></div>
                        </div>

                    </form>

                    <form method="POST" action="pay" enctype="multipart/form-data">
                        @csrf
                        <div class="pay_form2">
                            <h6> ... altrimenti inseriscine uno nuovo </h6>
                            <input name="libri" type="hidden" value="{{ $libri }}" >
                            <div><label class="pay_label">Titolare:</label><input name="nome_titolare" type="text" required></div>
                            <div><label class="pay_label">Numero carta:</label><input name="card_num" type="number" required></div>


                            <div class="date">
                                <label class="pay_label">Scadenza carta:</label><input name="mese" type="number" min="01" max="12" required><input name="anno" type="number" min="2020" max="2099" required>
                            </div>

                            <label class="pay_label">cvv:</label><input name="cvv" type="number" maxlength="3" required>

                            <div><input name="save_payment" type="checkbox"><label for="save_payment">&nbsp;&nbsp;vuoi salvare il metodo di pagamento inserito?</label></div>

                            <input id="pay_new_meth" type="submit" value="paga con il nuovo metodo di pagamento ">
                        </div>





                    </form>

                </div>



            </div>
        @else
            <div class="no-results">
                <h1 > Non hai ancora aggiunto alcun titolo al carrello </h1>
            </div>
        @endif

    @else
        <div class="no-results">
            <h1 >Effettua il log in per accedere al carrello </h1>
        </div>
    @endif


@endsection
