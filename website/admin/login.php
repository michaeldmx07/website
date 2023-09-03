<?php
session_start();
if($_POST){
  include("./bd.php");
  //Esta parte recoge los datos y los guarda en la base de datos <3
  $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
  $password=(isset($_POST['password']))?$_POST['password']:"";
  
  //Aqui estoy llamando los datos de la base local para mostrar 
  $sentencia=$conexion ->prepare("SELECT *
            FROM `tbl_usuarios`
            WHERE usuario=:usuario
            AND password=:password
            ");
  $sentencia ->bindParam(":usuario",$usuario);
  $sentencia ->bindParam(":password",$password);
  $sentencia->execute();



  $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);

  if($lista_usuarios){
    $_SESSION['usuario']=$lista_usuarios['usuario'];
    $_SESSION['logueado']=true;
    header("Location:index.php");
  }else{
      $mensaje="Error: El usuario o contraseña no son validos";
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio de Sesión</title>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" 
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
        crossorigin="anonymous">
  <style>
    body {
    background-image: url('../assets/img/candado.jgp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Esto asegura que la imagen permanezca fija mientras se desplaza la página */
    background-color: #f8f9fa; /* Un color de fondo de respaldo en caso de que la imagen no se cargue */
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #007bff;
      color: white;
      text-align: center;
      border-radius: 10px 10px 0 0;
    }
    .btn-login {
      background-color: #007bff;
      color: white;
    }
    .btn-login:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <main>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <?php if(isset($mensaje)){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong><?php echo $mensaje;?></strong>
            </div>
          <?php } ?>
          <div class="card">
            <div class="card-header">
              Acceso del Administrador
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="mb-3">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" class="form-control" name="usuario" id="usuario" 
                         placeholder="usuario@ejemplo.com" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" name="password" id="password" 
                         placeholder="*********" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-login">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
          integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" 
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" 
          integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" 
          crossorigin="anonymous"></script>
</body>
</html>
