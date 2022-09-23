@extends('templates.index')

@section('content')

{{-- NAVBAR --}}

<nav class="light-blue darken-4">
    <div class="container">
        <div class="nav-wrapper">
            {{-- <div class="container"> --}}
            <a href="#" class="brand-logo amber-text" style="font-size: 16pt; font-weight: bold">Misdinar MBL</a>
            <ul id="nav-mobile" class="right">
                @guest
                <li><a href="{{ route('login') }}"><i class="medium material-icons white-text">login</i></a></li>
                @endguest
                @auth
                <li><a href="{{ route('logout') }}"><i class="medium material-icons white-text">logout</i></a></li>
                @endauth
            </ul>
            {{-- </div> --}}
        </div>
    </div>
</nav>
{{-- END NAVBAR --}}

<section>
    <div class="container">
        @auth
        <p class="flow-text">Hi, {{ auth()->user()->name }}</p>
        @endauth

        <div class="row">
            <div class="col s12 m12">
                <x-menu-card to="{{ route('misdinar') }}" judul="Misdinar" deskripsi="Pelayan Altar" icon="wc" />
                <x-menu-card to="{{ route('program-kerja') }}" judul="Program Kerja" deskripsi="Rencana Kerja" icon="workspace_premium" />
                <x-menu-card to="{{ route('jadwal-ibadah') }}" judul="Jadwal Ibadah" deskripsi="Ibadah PPA" icon="church" />
                <x-menu-card to="{{ route('pelayan-misa') }}" judul="Pelayan Misa" deskripsi="Misdinar Bertugas" icon="supervised_user_circle" />
                <x-menu-card to="{{ route('keuangan') }}" judul="Keuangan" deskripsi="Laporan Keuangan" icon="account_balance_wallet" />
            </div>
        </div>
    </div>
</section>
@endsection
