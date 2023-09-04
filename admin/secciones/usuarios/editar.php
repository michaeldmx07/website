<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){
   
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion ->prepare(" SELECT * FROM tbl_usuarios WHERE id=:id ");
    $sentencia ->bindParam(":id",$txtID);
    $sentencia ->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];

}

if($_POST){

    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
    //Esta parte recoge los datos y los guarda en la base de datos <3
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";


    $sentencia=$conexion->prepare("UPDATE tbl_usuarios
    SET
    usuario=:usuario,
    password=:password,
    correo=:correo 
    WHERE id=:id ");

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();

    $mensaje="Registro agregado con exito";
    header("Location:index.php?mensaje=".$mensaje);


}

include("../../templates/header.php"); 

?>


<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
  <label for="" class="form-label">ID</label>
  <input type="text"
    class="form-control" readonly name="txtID" id="txtID" value="<?php echo $txtID;?>" aria-describedby="helpId" placeholder="">
</div>

 
<div class="mb-3">
  <label for="usuario" class="form-label">Usuario</label>
  <input type="text"
    class="form-control" value="<?php echo $usuario;?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
</div>


<div class="mb-3">
  <label for="password" class="form-label">Contraseña</label>
  <input type="password"
    class="form-control" value="<?php echo $password;?>" name="password" id="password" aria-describedby="helpId" placeholder="password">
</div>


<div class="mb-3">
  <label for="correo" class="form-label">Correo</label>
  <input type="text"
    class="form-control" value="<?php echo $correo;?>" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
</div>


<button type="submit" class="btn btn-success">Agregar</button>


<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


</form>

    </div>
    <div class="card-footer text-muted">
  
    </div>
</div>


<?php include("../../templates/footer.php"); ?>