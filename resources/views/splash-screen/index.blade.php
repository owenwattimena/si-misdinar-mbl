@extends('templates.index')

@section('content')

<section>
    <div class="container center">
        <div class="center" style="margin-top: 200px;">
            <h5>SISTEM INFORMASI MISDINAR MBL</h5>
            <img src="{{ asset('images/logo.jpeg') }}" width="40%" alt="">
        </div>
        <div class="row">

        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function delayFunction() {
        window.location = `{{ url('home') }}/`;
    }
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(delayFunction, 3000);
    });

</script>
@endsection
