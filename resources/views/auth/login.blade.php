@extends('templates.index')

@section('content')

<section>
    <div class="container">
        <div class="center" style="margin-top: 25px;">
            <img src="{{ asset('images/logo.jpeg') }}" width="40%" alt="">
        </div>
        <h5 style="margin-top: 0;">Masuk</h5>
        <p>Masuk untuk mengelolah data.</p>
        <div class="row">
            <form class="col s12" action="{{ route('login.do') }}" method="POST">
                @csrf
                <div class="row" style="margin-bottom: 0;">
                    <div class="input-field col s12" style="height: 40px;">
                        <input id="username" type="text" name="username" class="validate" required>
                        <label for="username">Username</label>
                        @error('username')
                        <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12" style="height: 40px;">
                        <input id="password" type="password" name="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>
                </div>
                <button class="btn waves-effect amber waves-light" type="submit" name="action" style="width: 100%;">MASUK
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
