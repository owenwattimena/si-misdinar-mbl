@extends('templates.index')


@section('content')

{{-- NAVBAR --}}
<div class="navbar-fixed">
    <nav class="light-blue darken-4">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ route('home') }}" class="brand-logo amber-text left"><i class="material-icons">arrow_back</i> Misdinar</a>
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
            <form action="{{ route('misdinar.store') }}" class="col s12" method="POST">
                <div class="modal-content black-text">
                    <h5 class="bold">Tambah Misdinar</h5>
                    <div class="row">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan nama" id="nama" type="text" name="nama" class="validate" required>
                                <label for="nama">Nama</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Masukan tempat lahir" id="tempat_lahir" type="text" name="tempat_lahir" class="validate" required>
                                <label for="tempat_lahir">Tempat Lahir</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Masukan tanggal lahir" id="tanggal_lahir" type="date" name="tanggal_lahir" class="validate" required>
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>
                            <div class="input-field col s12">
                                <select required class="validate" name="jenis_kelamin">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <label class="active">Jenis Kelamin</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Masukan jabatan" id="jabatan" type="text" name="jabatan" class="validate" required>
                                <label for="jabatan">Jabatan</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Masukan asal rukun" id="asal_rukun" type="text" name="asal_rukun" class="validate" required>
                                <label for="asal_rukun">Asal Rukun</label>
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

        <p class="flow-text">Data Misdinar</p>

        <blockquote style="margin: 0">Total {{ count($misdinar) }} Misdinar</blockquote>

        <div class="row">
            <div class="col s6 m6">
                <div class="card-panel teal">
                    <span class="white-text">Laki-laki <br>
                        <h3 style="margin: 0">{{ $jumlahLaki }}</h3>
                    </span>
                </div>
            </div>
            <div class="col s6 m6">
                <div class="card-panel teal">
                    <span class="white-text">Perempuan <br>
                        <h3 style="margin: 0">{{ $jumlahPerempuan }}</h3>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($misdinar as $item)
            <div class="col s12 m6">
                <div class="card-panel grey darken-4 vp-0">
                    <div class="row">
                        <div class="col">
                            <div class="m12">
                                <h6 class="white-text card-title bold">{{ $item->nama }}</h6>
                                <p class="no-margin white-text">{{ $item->jabatan }}</p>
                                <p class="no-margin white-text">{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</p>
                                <p class="no-margin white-text">{{ $item->jenis_kelamin }}</p>
                                <p class="white-text" style="margin-top: 0;">{{ $item->asal_rukun }}</p>
                                @auth
                                <a href="#modal{{ $item->id }}" class="waves-effect waves-teal btn-flat modal-trigger"><i class="medium material-icons yellow-text">edit</i></a>
                                <button class="waves-effect waves-teal btn-flat" onclick="hapus('{{ $item->id }}')"><i class="medium material-icons red-text">delete</i></button>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Structure -->
            <div id="modal{{ $item->id }}" class="modal modal-fixed-footer">
                <form action="{{ route('misdinar.update', $item->id) }}" class="col s12" method="POST">
                    <div class="modal-content black-text">
                        <h5 class="bold">Ubah Misdinar</h5>
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Masukan nama" id="nama" type="text" value="{{ $item->nama }}" name="nama" class="validate" required>
                                    <label for="nama">Nama</label>
                                </div>
                                <div class="input-field col s12">
                                    <input placeholder="Masukan tempat lahir" id="tempat_lahir" type="text" value="{{ $item->tempat_lahir }}" name="tempat_lahir" class="validate" required>
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                </div>
                                <div class="input-field col s12">
                                    <input placeholder="Masukan tanggal lahir" id="tanggal_lahir" type="date" value="{{ $item->tanggal_lahir }}" name="tanggal_lahir" class="validate" required>
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                </div>
                                <div class="input-field col s12">
                                    <select required class="validate" name="jenis_kelamin">
                                        <option value="" disabled>Pilih</option>
                                        <option value="Laki-laki" {{ $item->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $item->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <label class="active">Jenis Kelamin</label>
                                </div>
                                <div class="input-field col s12">
                                    <input placeholder="Masukan jabatan" id="jabatan" type="text" value="{{ $item->jabatan }}" name="jabatan" class="validate" required>
                                    <label for="jabatan">Jabatan</label>
                                </div>
                                <div class="input-field col s12">
                                    <input placeholder="Masukan asal rukun" id="asal_rukun" type="text" value="{{ $item->asal_rukun }}" name="asal_rukun" class="validate" required>
                                    <label for="asal_rukun">Asal Rukun</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="waves-effect waves-green btn-flat">Simpan</button>
                    </div>
                </form>
            </div>
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

        M.FormSelect.init(document.querySelectorAll('select'));

    });

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Misdinar'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                window.location = `{{ url('misdinar') }}/` + id;
            }
        })
    }

</script>
@endsection
