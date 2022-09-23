@extends('templates.index')


@section('content')

{{-- NAVBAR --}}
<div class="navbar-fixed">

    <nav class="light-blue darken-4">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ url('/') }}" class="brand-logo amber-text left font16"><i class="material-icons ">arrow_back</i> JADWAL IBADAH</a>
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
            <form action="{{ route('jadwal-ibadah.store') }}" class="col s12" method="POST">
                <div class="modal-content black-text">
                    <h5 class="bold">Tambah Jadwal Ibadah</h5>
                    <div class="row">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan tanggal" id="tanggal" type="date" name="tanggal" class="validate" required>
                                <label for="tanggal">Tanggal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan jam" id="jam" type="time" name="jam" class="validate" required>
                                <label for="jam">Tanggal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan tempat ibadah" id="tempat_ibadah" type="text" name="tempat_ibadah" class="validate" required>
                                <label for="tempat_ibadah">Tempat Ibadah</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan pemimpin ibadah" id="pemimpin_ibadah" type="text" name="pemimpin_ibadah" class="validate" required>
                                <label for="pemimpin_ibadah">Pemimpin Ibadah</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan permainan/sharing" id="permainan_sharing" type="text" name="permainan_sharing" class="validate" required>
                                <label for="permainan_sharing">Permainan/Sharing</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan pembawa lagu" id="pembawa_lagu" type="text" name="pembawa_lagu" class="validate" required>
                                <label for="pembawa_lagu">Pembawa Lagu</label>
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

        <p class="flow-text">Ibadah PPA</p>
        <div class="row">

            @foreach ($jadwal as $item)
            <div class="col m4 s12">

                <div class="card-panel black darken-4 vp-0">
                    <div class="row">
                        <div class="col">
                            <div class="m3">
                                <i class="medium material-icons amber-text" style="margin-top: 35px">church</i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="m9">
                                @php
                                setLocale(LC_TIME, 'id_ID');
                                $date=strftime("%a, %d %b %Y", strtotime($item->tanggal));
                                @endphp
                                <h6 class="white-text card-title bold" style="font-size: 10pt">{{ $date }}</h6>
                                <p class="white-text no-margin"><i class="tiny material-icons green-text">access_time</i> {{ $item->jam }} WIT</p>
                                <p class="white-text no-margin"><i class="tiny material-icons green-text">location_on</i> {{ $item->tempat_ibadah }}</p>
                                <p class="white-text no-margin"><i class="tiny material-icons green-text">attribution</i> {{ $item->pemimpin_ibadah }}</p>
                                <p class="white-text no-margin"><i class="tiny material-icons green-text">casino</i> {{ $item->permainan_sharing }}</p>
                                <p class="white-text no-margin mb-15"><i class="tiny material-icons green-text">music_note</i> {{ $item->pembawa_lagu }}</p>
                                
                                @auth
                                <a href="#modal{{ $item->id }}" class="modal-trigger btn btn-flat"><i class="medium material-icons amber-text">edit</i></a>
                                <button class="btn btn-flat" onclick="return hapus('{{ $item->id }}')"><i class="medium material-icons red-text">delete</i></button>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                <!-- Modal Structure -->
                <div id="modal{{ $item->id }}" class="modal modal-fixed-footer">
                    <form action="{{ route('jadwal-ibadah.update', $item->id) }}" class="col s12" method="POST">
                        <div class="modal-content black-text">
                            <h5 class="bold">Ubah Jadwal Ibadah</h5>
                            <div class="row">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Masukan tanggal" id="tanggal" type="date" value="{{ $item->tanggal }}" name="tanggal" class="validate" required>
                                        <label for="tanggal">Tanggal</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Masukan jam" id="jam" type="time" value="{{ $item->jam }}" name="jam" class="validate" required>
                                        <label for="jam">Jam</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Masukan tempat ibadah" id="tempat_ibadah" value="{{ $item->tempat_ibadah }}" type="text" name="tempat_ibadah" class="validate" required>
                                        <label for="tempat_ibadah">Tempat Ibadah</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Masukan pemimpin ibadah" id="pemimpin_ibadah" type="text" value="{{ $item->pemimpin_ibadah }}" name="pemimpin_ibadah" class="validate" required>
                                        <label for="pemimpin_ibadah">Pemimpin Ibadah</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Masukan permainan/sharing" id="permainan_sharing" type="text" value="{{ $item->permainan_sharing }}" name="permainan_sharing" class="validate" required>
                                        <label for="permainan_sharing">Permainan/Sharing</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Masukan pembawa lagu" id="pembawa_lagu" type="text" value="{{ $item->pembawa_lagu }}" name="pembawa_lagu" class="validate" required>
                                        <label for="pembawa_lagu">Pembawa Lagu</label>
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

    });

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Jadwal Ibadah'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                window.location = `{{ url('jadwal-ibadah/delete') }}/` + id;
            }
        })
    }

</script>
@endsection
