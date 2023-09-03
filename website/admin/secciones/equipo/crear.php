<?php 
include("../../bd.php");
if($_POST){

    //Esta parte recoge los datos y los guarda en la base de datos <3
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
    $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
    $urltwitter=(isset($_POST['urltwitter']))?$_POST['urltwitter']:"";
    $urlfacebook=(isset($_POST['urlfacebook']))?$_POST['urlfacebook']:"";
    $urllinkedin=(isset($_POST['urllinkedin']))?$_POST['urllinkedin']:"";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
      move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
    }


    $sentencia=$conexion ->prepare("INSERT INTO `tbl_equipo` (`ID`, `imagen`, `nombrecompleto`, `puesto`, `urltwitter`, `urlfacebook`, `urllinkedin`) 
    VALUES (NULL,:imagen,:nombrecompleto,:puesto,:urltwitter,:urlfacebook,:urllinkedin);");

    $sentencia ->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia ->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia ->bindParam(":puesto",$puesto);
    $sentencia ->bindParam(":urltwitter",$urltwitter);
    $sentencia ->bindParam(":urlfacebook",$urlfacebook);
    $sentencia ->bindParam(":urllinkedin",$urllinkedin);

    $sentencia->execute();
    $mensaje="Registro agregado con exito";
    header("Location:index.php?mensaje=".$mensaje);

}

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        Equipo 
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
  <label for="imagen" class="form-label">Imagen</label>
  <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
</div>

 
<div class="mb-3">
  <label for="nombrecompleto" class="form-label">Nombre completo</label>
  <input type="text"
    class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre completo">
</div>


<div class="mb-3">
  <label for="puesto" class="form-label">Puesto</label>
  <input type="text"
    class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
</div>


<div class="mb-3">
  <label for="urltwitter" class="form-label">Twitter</label>
  <input type="text"
    class="form-control" name="urltwitter" id="urltwitter" aria-describedby="helpId" placeholder="Twitter">
</div>


<div class="mb-3">
  <label for="urlfacebook" class="form-label">Facebook</label>
  <input type="text"
    class="form-control" name="urlfacebook" id="urlfacebook" aria-describedby="helpId" placeholder="Facebook">
</div>

<div class="mb-3">
  <label for="urllinkedin" class="form-label">Linkedin</label>
  <input type="text"
    class="form-control" name="urllinkedin" id="urllinkedin" aria-describedby="helpId" placeholder="Linkedin">
</div>


<button type="submit" class="btn btn-success">Agregar</button>


<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


</form>

    </div>
    <div class="card-footer text-muted">
  
    </div>
</div>

<?php include("../../templates/footer.php"); ?>