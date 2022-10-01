@extends('templates.index')

@section('content')

<section>
    <div class="container center">
        <div class="center center-align" style="margin-top: 200px;">
            <h5>SISTEM INFORMASI MISDINAR MBL</h5>
            <img src="{{ asset('images/logo.jpeg') }}" width="40%" alt="">
            <div class="row">
                <div class="col s6 offset-s3">
                    <div class="progress" >
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </div>
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
        setTimeout(delayFunction, 5000);
    },false);

</script>
@endsection
