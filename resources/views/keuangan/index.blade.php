@extends('templates.index')

@section('style')
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
@endsection

@section('content')

{{-- NAVBAR --}}
<div class="navbar-fixed">

    <nav class="light-blue darken-4">
        <div class="container">

            <div class="nav-wrapper">
                <a href="{{ route('home') }}" class="brand-logo amber-text left font16"><i class="material-icons ">arrow_back</i> KEUANGAN</a>
                @auth
                <ul id="nav-mobile" class="right">
                    <li><a href="#modal" class="waves-effect waves-light btn btn-flat modal-trigger"><i class="medium material-icons white-text">add</i></a></li>
                </ul>
                @endauth
            </div>
        </div>
        @auth

        <!-- Modal Structure -->
        <div id="modal" class="modal modal-fixed-footer">
            <form action="{{ route('keuangan.store') }}" class="col s12" method="POST">
                <div class="modal-content black-text">
                    <h5 class="bold">Transaksi</h5>
                    <div class="row">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Masukan misa" id="tanggal" type="datetime-local" value="{{ $date}}" name="tanggal" class="validate" required>
                                <label for="tanggal">Tanggal</label>
                            </div>
                            <div class="input-field col s12">
                                <select required class="validate" name="tipe">
                                    <option value="kredit">Kredit</option>
                                    <option value="debit">Debit</option>
                                </select>
                                <label class="active">Tipe</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Jumlah" id="jumlah" type="number" name="jumlah" class="validate" required>
                                <label for="jumlah">Jumlah</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Keterangan" id="keterangan" type="text" name="keterangan" class="validate" required>
                                <label for="keterangan">Keterangan</label>
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
        <div class="row">
            <div class="col s6 right-align">
            </div>
            <div class="col s6 right-align">
                
                {{-- <jsuites-calendar value="{{ $date }}" year-month-picker></jsuites-calendar> --}}
                <input id='calendar' value="{{ $date }}" style="margin-bottom: 0; height: 30px; width: 100px;">
            </div>
            <div class="col s12">
                <div class="row" style="margin-bottom: 0;">
                    <div class="col s12 m5" style="padding: 0;">
                        <div class="card-panel white center-align vp-0" style="padding: 0; margin-bottom: 0;">
                            <div class="row" style="margin-bottom: 0;">
                                <div class="col s4 bold green-text darken-4" style="padding: 0;">Debit<br>
                                    <h6 style="font-size: 12px">Rp. {{ number_format($debit ) }}</h6>
                                </div>
                                <div class="col s4 bold red-text darken-4" style="padding: 0;">Kredit<br>
                                    <h6 style="font-size: 12px">Rp. {{ number_format($kredit) }}</h6>
                                </div>
                                <div class="col s4 bold blue-text darken-4" style="padding: 0;">Saldo<br>
                                    <h6 style="font-size: 12px">Rp. {{ number_format( $saldo ) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="collection">
                    @forelse ($keuangan as $item)
                    @php
                    setLocale(LC_TIME, 'id_ID');
                    $date=strftime("%a, %d %b %Y", strtotime($item->tanggal));
                    @endphp
                    <li class="collection-item">
                        <div>{{ $date }} <br> {{ $item->keterangan }} <span class="secondary-content valign-wrapper"> <span class="{{ $item->tipe == 'kredit' ? 'red' : 'green' }}-text" style="margin-top: 0px;">Rp. {{ number_format($item->jumlah) }}</span> @auth<i class="material-icons" style="margin-left: 20px;" onclick="return hapus('{{ route('keuangan.delete', $item->id) }}')">delete</i> @endauth </span></div>
                    </li>
                    @empty
                    Tidak ada data.
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://jsuites.net/v4/jsuites.js"></script>
<script src="https://jsuites.net/v4/jsuites.webcomponents.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var calendar = jSuites.calendar(document.getElementById('calendar'), {
            type: 'year-month-picker'
            , format: 'MM-YYYY'
            , onchange: function(element, newVal, oldVal) {
                if (oldVal != null) {
                    var arr_date = newVal.split(' ');
                    console.log(arr_date);
                    // return
                    window.location = `{{ url('keuangan') }}?tanggal=` + arr_date[0];
                }
            }
        });

        var elems = document.querySelectorAll('#modal');
        var instances = M.Modal.init(elems);
        M.Modal.init(document.querySelectorAll('.modal'));

        M.FormSelect.init(document.querySelectorAll('select'));

    });

    function hapus(route) {
        Swal.fire({
            title: 'Hapus Transaksi'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                window.location = route;
            }
        })
    }

</script>
@endsection
