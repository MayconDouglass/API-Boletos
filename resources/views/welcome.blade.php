<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">

        <div class="top-right links">

            <a href="{{ url('/home') }}">Home</a>

            <a href="{{  url('api/auth/logout') }}">Sair</a>

        </div>

        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Dasdascs</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>

        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
    var token = getCookie('sig2000');
    var token2 = getCookie('sig2000teste');
         console.log(token2);
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/api/empresas/rest/generator/'+ '21034355000171',
        headers: {
            'Authorization': 'Bearer' +token2
        },

        success: function (result) {
            console.log(result);

        },
        error: function (resultError) {

            console.log('Erro na consulta');

        }

    });
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/api/clientes',
        headers: {
            'Authorization': 'Bearer' +token2 
        },

        success: function (result) {
            console.log(result);

        },
        error: function (resultError) {

            console.log('Erro na consulta');

        }

    });

    function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
</script>

</html>