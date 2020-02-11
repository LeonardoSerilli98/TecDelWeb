@extends('layouts.main')


@section('content')
    @if (Auth::check() && Auth::id() == $id)
        <h1 class="nome-utente">{{ Auth::user()->name }}</h1>

        <div class="profilo-cose">
            <div class="paymethods">
                <h3>metodi di pagamento</h3>
                @foreach($metodi as $metodo)
                    <div>
                        <form method="get" action="/paymethods/{{ $metodo->id }}">

                            <div class="paymethod-delete">
                               <div>
                                   <label class="paymet_label">Titolare:</label>
                                   <h6>{{ $metodo->nome_titolare  }}</h6>
                               </div>
                                <div class="carta">
                                    <label class="paymet_label">Carta:</label>
                                    <h6>{{ $metodo->num_carta }}</h6>
                                    <button class="bottone" type="submit"><i class="fas fa-backspace"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach

            </div>
            <div>
                <form method="POST" action="/paymethods" enctype="multipart/form-data">
                    @csrf
                    <div class="pay_form2">
                        <h3> inserisci un metodo di pagamento </h3>
                        <div><label class="pay_label">Titolare:</label><input class="input-important" name="nome_titolare" type="text" required></div>
                        <div><label class="pay_label">Numero carta:</label><input class="input-important" name="num_carta" type="number" required></div>



                        <div class="date">
                            <label class="pay_label">Scadenza carta:</label><input class="input-expire" name="mese" type="number" min="01" max="12" required>
                            <input class="input-expire" name="anno" type="number" min="20" max="99" required>
                        </div>

                        <label class="pay_label">cvv:</label><input name="cvv" class="input-cvv" type="number" maxlength="3" required>

                        <br>

                        <button class="bottone" type="submit"><i class="fas fa-check-circle"></i></button>
                    </div>
                </form>
            </div>
            <div class="change-profile">
                <div class="cambia-email">
                    <div>
                        <h3>cambia la tua email</h3>
                    </div>

                    <div>
                        <form method="post" action="/profile/{{ $id }}">
                            @csrf

                            <label class="profile-label">nuova email</label><input type="email" name="email" class="field-profilo @error('email') is-invalid @enderror" required >

                            @error('email')
                                <div class="alert alert-danger">la email inserita non è corretta</div>
                            @enderror
                            <button class="bottone" type="submit"><i class="fas fa-check-circle"></i></button>
                        </form>
                    </div>

                </div>
                <div class="cambia-email">
                    <div>
                        <h3>cambia la tua password</h3>
                    </div>
                    <div>
                        <form method="post" action="/profile/{{ $id }}">
                            @csrf

                            <label class="profile-label">nuova password</label><input type="password" name="password" class="field-profilo" required>
                            <label class="profile-label">conferma password</label><input type="password" name="confirm_password" class="field-profilo @error('confirm_password') is-invalid @enderror" required>
                            @error('confirm_password')
                                <div class="alert alert-danger">le password non sono uguali</div>

                            @enderror
                            <button class="bottone" type="submit"><i class="fas fa-check-circle"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @else
        <div class="no-results">
            <h1>Non puoi visualizzare questa pagina</h1>
        </div>
    @endif
@endsection
