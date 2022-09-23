<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('style')
    <style>
        .vp-0 {
            padding-top: 0px !important;
            padding-bottom: 0px !important;
        }

        .no-margin {
            margin: 0 !important;
        }

        .bold {
            font-weight: bold !important;
        }

        .mt-5 {
            margin-top: 5px !important;
        }
        .font16{
            font-size: 16pt!important;
        }
        .font12{
            font-size: 12pt!important;
        }
        .mb-15{
            margin-bottom: 15px!important;
        }

    </style>
</head>

<body>

    @yield('content')

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('status'))
            M.toast({
                html: `{!! session('message') !!}`
                , classes: `{!! session('status') !!}`
            });
            @endif

        });

    </script>
</body>
</html>
