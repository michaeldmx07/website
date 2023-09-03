<?php 
session_start();
$url_base = "http://website-production-5b02.up.railway.app/admin/"; 
if(!isset($_SESSION['usuario'])){
  header("Location:".$url_base."loin.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Administrador web</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/portafolio/">Productos</a>
            <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/entradas/">Entradas</a>
            <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/equipo/">Equipo</a>
            <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a>
            <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/mensaje/">Clientes Sugerencias</a>
            <a class="nav-item nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar sesion</a>
        </div>
    </nav>

  </header>
  <main class="container">
    <br/>