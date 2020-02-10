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
                            @csrf
                            <div class="paymethod-delete">
                                <label>titolare:</label><h5> {{ $metodo->nome_titolare  }}</h5>
                                <div>
                                    <h5>carta: {{ $metodo->num_carta }}</h5>
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
                        <h6> inserisci un metodo di pagamento </h6>
                        <div><label class="pay_label">Titolare:</label><input name="nome_titolare" type="text" required></div>
                        <div><label class="pay_label">Numero carta:</label><input name="num_carta" type="number" required></div>


                        <div class="date">
                            <label class="pay_label">Scadenza carta:</label><input name="mese" type="number" min="01" max="12" required><input name="anno" type="number" min="2020" max="2099" required>
                        </div>

                        <label class="pay_label">cvv:</label><input name="cvv" type="number" maxlength="3" required>

                        <br>

                        <input type="submit" value="inserisci il nuovo metodo di pagamento ">
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
                            <label class="profile-label">nuova email</label><input type="email" name="email" class="field-profilo">
                            <button type="submit">Conferma</button>
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
                            <label class="profile-label">nuova password</label><input type="password" name="password" class="field-profilo">
                            <label class="profile-label">conferma password</label></label><input type="password" name="confirm-password" class="field-profilo">
                            <button type="submit">Conferma</button>
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
