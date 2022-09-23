@extends('templates.index')


@section('content')

{{-- NAVBAR --}}
<div class="navbar-fixed">

    <nav class="light-blue darken-4">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ url('/') }}" class="brand-logo amber-text left font16"><i class="material-icons ">arrow_back</i> PELAYAN MISA</a>
                @auth
                <ul id="nav-mobile" class="right">
                    <li><a href="#modal" class="waves-effect waves-light btn modal-trigger btn-flat"><i class="medium material-icons white-text">add</i></a></li>
                </ul>
                @endauth
            </div>
        </div>
        @auth
        <!-- Modal Structure -->
        <div id="modal" class="modal modal-fixed-footer">
            <form action="{{ route('pelayan-misa.store') }}" class="col s12" method="POST">
                <div class="modal-content black-text">
                    <h5 class="bold">Pelayan Misa</h5>
                    <div class="row">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan tanggal" id="tanggal" type="date" name="tanggal" class="validate" required>
                                <label for="tanggal">Tanggal</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
                </div>
            </form>
        </div>
        @endauth
    </nav>
</div>
{{-- END NAVBAR --}}

<section>
    <div class="container">

        <p class="flow-text">Misdinar Bertugas</p>
        <div class="row">
            @foreach ($pelayanMisa as $item)
            @php
            setLocale(LC_TIME, 'id_ID');
            $date=strftime("%a, %d %b %Y", strtotime($item->tanggal));
            @endphp
            <div class="col s12 m5">
                <a href="{{ route('pelayan-misa.misa', $item->id) }}">
                    <div class="card-panel black vp-0">
                        <div class="row">
                            <div class="col s3">
                                <i class="medium material-icons amber-text" @auth style="margin-top: 35px" @endauth  @guest style="margin-top: 10px" @endguest>supervised_user_circle</i>
                            </div>
                            <div class="col s9">
                                <h6 class="white-text bold">{{ $date }}</h6>
                                <p class="white-text">Pelayan Misa</p>
                                @auth
                                <a href="#modal{{ $item->id }}" class="btn btn-flat modal-trigger"><i class="material-icons amber-text">edit</i></a>
                                <button class="btn btn-flat" onclick="return hapus('{{ $item->id }}')"><i class="material-icons red-text">delete</i></button>
                                @endauth
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @auth
            <!-- Modal Structure -->
            <div id="modal{{ $item->id }}" class="modal modal-fixed-footer">
                <form action="{{ route('pelayan-misa.update', $item->id) }}" class="col s12" method="POST">
                    <div class="modal-content black-text">
                        <h5 class="bold">Pelayan Misa</h5>
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Masukan tanggal" id="tanggal" type="date" value="{{ $item->tanggal }}" name="tanggal" class="validate" required>
                                    <label for="tanggal">Tanggal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
                    </div>
                </form>
            </div>
            @endauth
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var elems = document.querySelectorAll('#modal');
        var instances = M.Modal.init(elems);
        M.Modal.init(document.querySelectorAll('.modal'));

    });

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Jadwal Misa'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                window.location = `{{ url('pelayan-misa/delete') }}/` + id;
            }
        })
    }

</script>
@endsection
