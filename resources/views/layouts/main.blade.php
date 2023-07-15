<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
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
  background-color: #04AA6D;
}
</style>

<title>@yield('title')</title>

</head>
<body>

<ul>
  <li><a class="active" href="/">Home</a></li>

  @auth
  <li><a href="/manifestations/create">Fazer manifestacao</a></li>
  <li><a href="/dashboard">Minha conta</a></li>
  @endauth

  @guest
  <li><a href="/login">Entrar</a></li>
  <li><a href="/register">Fazer cadastro</a></li>
  @endguest

</ul>

@yield('content')
</body>


</html>