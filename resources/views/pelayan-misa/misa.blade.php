@extends('templates.index')


@section('content')

{{-- NAVBAR --}}
<div class="navbar-fixed">

    <nav class="light-blue darken-4">
        <div class="container">
            <div class="nav-wrapper">
                @php
                setLocale(LC_TIME, 'id_ID');
                $date=strftime("%a, %d %b %Y", strtotime($jadwal->tanggal));
                @endphp
                <a href="{{ route('home') }}" class="brand-logo amber-text left font16"><i class="material-icons ">arrow_back</i> {{ $date }}</a>
                @auth
                <ul id="nav-mobile" class="right">
                    <li><a href="#modal" class="waves-effect waves-light btn modal-trigger btn-flat"><i class="medium material-icons white-text">add</i></a></li>
                </ul>
                @endauth
            </div>
        </div>
        <!-- Modal Structure -->
        <div id="modal" class="modal modal-fixed-footer">
            <form action="{{ route('pelayan-misa.misa.store', $jadwal->id) }}" class="col s12" method="POST">
                <div class="modal-content black-text">
                    <h5 class="bold">Misa</h5>
                    <div class="row">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan misa" id="misa" type="text" name="misa" class="validate" required>
                                <label for="misa">Misa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
                </div>
            </form>
        </div>
    </nav>
</div>
{{-- END NAVBAR --}}

<section>
    <div class="container">

        <p class="flow-text">Pelayan Misa</p>
        <ul class="collapsible">
            @foreach ($misa as $item)

            <li>
                <div class="collapsible-header">
                    @auth

                    <a href="#misa{{ $item->id }}" class="btn btn-flat modal-trigger" style="padding: 0">
                        <i class="material-icons green-text" style="margin-right: 0;">add</i>
                    </a>
                    <!-- Modal Structure -->
                    <div id="misa{{ $item->id }}" class="modal modal-fixed-footer">
                        <form action="{{ route('pelayan-misa.misa.store.misdinar', ['id' => $jadwal->id, 'idMisa' => $item->id]) }}" class="col s12" method="POST">
                            <div class="modal-content black-text">
                                <h5 class="bold">Misdinar</h5>
                                <div class="row">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select name="id_misdinar">
                                                <option value="" disabled selected>Pilih Misdinar</option>
                                                @foreach ($misdinar as $value)
                                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label>Misdinar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <a href="#edit{{ $item->id }}" class="btn btn-flat modal-trigger" style="padding: 0">
                        <i class="material-icons amber-text" style="margin-right: 0;">edit</i>
                    </a>
                    <!-- Modal Structure -->
                    <div id="edit{{ $item->id }}" class="modal modal-fixed-footer">
                        <form action="{{ route('pelayan-misa.misa.update', ['id' => $jadwal->id, 'idMisa' => $item->id]) }}" class="col s12" method="POST">
                            <div class="modal-content black-text">
                                <h5 class="bold">Ubah Misa</h5>
                                <div class="row">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input placeholder="Masukan misa" id="misa" type="text" value="{{ $item->misa }}" name="misa" class="validate" required>
                                            <label for="misa">Misa</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <button class="btn btn-flat" style="padding: 0" onclick="return hapusMisa('{{ route('pelayan-misa.misa.delete',  ['id' => $jadwal->id, 'idMisa' => $item->id]) }}')">
                        <i class="material-icons red-text" style="margin-right: 0;">delete</i>
                    </button>
                    @endauth

                    <span style="margin-top: 8px; margin-left: 80x;">{{ $item->misa }}</span>
                </div>
                <div class="collapsible-body" style="padding: 0; padding-left: 25px; padding-top: 0;">
                    <ul class="collection">
                        @forelse ($item->pelayan as $data)
                        <li class="collection-item">{{ $data->misdinar->nama }} @auth<a href="#!" class="secondary-content" onclick="return hapusMisdinar('{{ route('pelayan-misa.misa.store.misdinar.hapus', ['id' => $jadwal->id, 'idMisa' => $item->id, 'idPelayan' => $data->id]) }}')"><i class="material-icons red-text">delete</i></a>@endauth</li>
                        @empty
                        Tidak ada misdinar.
                        @endforelse
                    </ul>
                </div>
            </li>
            @endforeach

        </ul>
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

        M.Collapsible.init(document.querySelectorAll('.collapsible'));
        M.FormSelect.init(document.querySelectorAll('select'));
    });

    function hapusMisa(route) {
        // var url = `{{ url('') }}`;
        // var path = `${id_jadwal}/misa/${id_misa}/hapus`;
        Swal.fire({
            title: 'Hapus Misa'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                // window.location = url + '/' + path;
                window.location = route;
            }
        })
    }

    function hapusMisdinar(route) {
        // var url = `{{ url('') }}`;
        // var path = `${id_jadwal}/misa/${id_misa}/hapus`;
        Swal.fire({
            title: 'Hapus Misdinar'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                // window.location = url + '/' + path;
                window.location = route;
            }
        })
    }

</script>
@endsection
