@extends('templates.index')

@section('style')
<!-- Include stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.min.css" integrity="sha512-Bhi4560umtRBUEJCTIJoNDS6ssVIls7oiYyT3PbhxZV+9uBbLVO/mWo56hrBNNbIfMXKvtIPJi/Jg+vpBpA7sg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')


{{-- NAVBAR --}}
<form action="{{ route('program-kerja.update', $programKerja->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="navbar-fixed">
        <nav class="light-blue darken-4">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="{{ route('home') }}" class="brand-logo amber-text left font12 truncate"><i class="material-icons ">arrow_back</i> {{ $programKerja->seksi }}</a>
                    @auth
                    <ul id="nav-mobile" class="right">
                        <li><button type="submit" class="waves-effect waves-light btn-flat"><i class="tiny material-icons white-text" style="margin-top: -12px">save</i></button></li>
                    </ul>
                    @endauth
                </div>
            </div>

        </nav>
    </div>
    {{-- END NAVBAR --}}

    <section>
        <div class="container">
            @guest
            <h4>Periode : {{ $programKerja->periode }}</h4>
            {!! $programKerja->program_kerja !!}
            @endguest

            @auth
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="seksi" type="text" name="seksi" value="{{ $programKerja->seksi }}" class="validate" required>
                            <label for="seksi">Seksi</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="periode" type="text" name="periode" value="{{ $programKerja->periode }}" placeholder="Cth: 2022-2026" class="validate" required>
                            <label for="periode">Periode</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <!-- element to edit -->
                            <textarea id="editor" name="program_kerja" required>{!! $programKerja->program_kerja !!}</textarea>
                        </div>
                    </div>
                </form>
            </div>
            @endauth
        </div>
    </section>
</form>
@endsection

@section('script')
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.tiny.cloud/1/jujlw32q6s63oorfl0y0orwk0fl498uabaybevidcgrvohkp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>

<!-- rules defining tags, attributes and classes that are allowed -->
<script src="bower_components/wysihtml/parser_rules/advanced_and_extended.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#editor'
            , plugins: 'lists advlist'
            , mobile: {
                menubar: true
            }
        });
    });

</script>
@endsection
