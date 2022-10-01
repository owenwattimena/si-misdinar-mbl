@extends('templates.index')


@section('content')

{{-- NAVBAR --}}
<div class="navbar-fixed">

    <nav class="light-blue darken-4">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ url('/') }}" class="brand-logo amber-text left font16"><i class="material-icons ">arrow_back</i> PROGRAM KERJA</a>
                @auth
                <ul id="nav-mobile" class="right">
                    <li><a href="{{ route('program-kerja.tambah') }}" class="waves-effect waves-light btn btn-flat"><i class="medium material-icons white-text">add</i></a></li>
                </ul>
                @endauth
            </div>
        </div>

    </nav>
</div>
{{-- END NAVBAR --}}

<section>
    <div class="container">

        <p class="flow-text">Rencana Kerja</p>
        <div class="row">
            <ul class="collection">
                @foreach ($programKerja as $item)
                <a href="{{ route('program-kerja.detail', $item->id) }}">
                    <li class="collection-item">{{ $item->seksi }} @auth<a href="#" onclick="return hapus('{{ $item->id }}')" class="secondary-content"><i class="material-icons">delete</i></a>@endauth</li>
                </a>
                @endforeach
            </ul>
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
            title: 'Hapus Program Kerja'
            , text: 'Yakin ingin menghapus data?'
        , }).then((result) => {
            if (result.isConfirmed) {
                window.location = `{{ url('program-kerja/delete') }}/` + id;
            }
        })
    }

</script>
@endsection
