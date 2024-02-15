<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'JetBrains Mono', monospace;
        }

        .navbar {}



        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #000000;
        }

        li {
            display: inline-block;
            /* Alterado de float: left; */
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #ffffff;
            color: #000000;
            border: 2px solid #000000;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .container {
            width: 80%;
            max-width: 880px;
            border: 1px solid rgb(207, 207, 207);
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            /* Empilhamento vertical */
            justify-content: center;
            align-items: center;
        }

        .container-item {
            width: 100%;

            margin-top: 10%;
            margin-bottom: 20px;
            /* Adicione espaço entre os itens */
        }

        .map-container {
            width: 100%;
            height: 500px;
            margin-bottom: 20px;
            /* Adicione espaço inferior para separar o mapa da tabela */
        }

        table {
            width: 100%;
            /* Ajusta a largura da tabela ao contêiner pai */
            font-family: arial, sans-serif;
            border-collapse: collapse;
        }

        #edit-button {
            color: rgb(0, 0, 0);
        }

        #delete-button {
            text-decoration: none;
            background: rgb(219, 82, 82);
            color: rgb(255, 255, 255);
            border: 2px solid red;
            border-radius: 5px;
        }

        #submit-button {
            font-size: 20px;
            padding: 10px;
            margin: 20px 0px 30px 0px;
            color: #ffffff;
            background: #000000;
            display: flex;
            justify-content: flex-end;
        }

        .manifestation-types-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .manifestation-type-button {
            margin-right: 10px;
            margin-bottom: 10px;
        }

        #type-button {
            text-decoration: none;
            background: #ffffff;
            color: #000000;
            font-weight: bold;
            font-size: 15px;
        }

        /* Outros estilos da tabela... */
    </style>


    <title>@yield('title')</title>

</head>

<body>

    <div class="navbar">
        <ul>
            <li><a class="active" href="/">ComuniCatu</a></li>

            @auth
                <li><a href="/manifestations/create">Fazer manifestacao</a></li>
                <li><a href="/manifestations/show">Minhas manifestacoes</a></li>
                <li><a href="/dashboard">Minha conta</a></li>
            @endauth

            @guest
                <li><a href="/login">Entrar</a></li>
                <li><a href="/register">Fazer cadastro</a></li>
            @endguest
        </ul>
        @if (session('msg'))
            <div class="msg"
                style="background: green; color:greenyellow; border-radius:3px; width:100%; height: 30px; margin:5px;">
                <p class="msg">{{ session('msg') }}</p>
        @endif
    </div>

    @yield('content')
</body>




</html>
