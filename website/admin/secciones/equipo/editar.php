<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){
   
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion ->prepare(" SELECT * FROM tbl_equipo WHERE id=:id ");
    $sentencia ->bindParam(":id",$txtID);
    $sentencia ->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $imagen=$registro["imagen"];
    $nombrecompleto=$registro["nombrecompleto"];
    $puesto=$registro["puesto"];
    $urltwitter=$registro["urltwitter"];
    $urlfacebook=$registro["urlfacebook"];
    $urllinkedin=$registro["urllinkedin"];

}

if($_POST){

    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
    //Esta parte recoge los datos y los guarda en la base de datos <3
    $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
    $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
    $urltwitter=(isset($_POST['urltwitter']))?$_POST['urltwitter']:"";
    $urlfacebook=(isset($_POST['urlfacebook']))?$_POST['urlfacebook']:"";
    $urllinkedin=(isset($_POST['urllinkedin']))?$_POST['urllinkedin']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_equipo
    SET
    imagen=:imagen,
    nombrecompleto=:nombrecompleto,
    puesto=:puesto,
    urltwitter=:urltwitter,
    urlfacebook=:urlfacebook,
    urllinkedin=:urllinkedin
    WHERE id=:id ");

    $sentencia->bindParam(":imagen",$imagen);
    $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":urltwitter",$urltwitter);
    $sentencia->bindParam(":urlfacebook",$urlfacebook);
    $sentencia->bindParam(":urllinkedin",$urllinkedin);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();


    if($_FILES["imagen"]["name"]!=""){
      $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";

      $fecha_imagen=new DateTime();
      $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
      $tmp_imagen=$_FILES["imagen"]["tmp_name"];
      
        move_uploaded_file($tmp_imagen,"../../../assets/img/".$nombre_archivo_imagen);
      

        //Consulta para borrar la imagen a traves del nombre.
        $sentencia=$conexion ->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id ");
        $sentencia ->bindParam(":id",$txtID);
        $sentencia ->execute();
        $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    
        if(isset($registro_imagen["imagen"])){
            if(file_exists("../../../assets/img/".$registro_imagen["imagen"])){
                unlink("../../../assets/img/".$registro_imagen["imagen"]);
            }
        }

      $sentencia=$conexion->prepare("UPDATE tbl_equipo 
      SET imagen=:imagen WHERE id=:id ");

      $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();

    }

    $mensaje="Registro agregado con exito";
    header("Location:index.php?mensaje=".$mensaje);


}

include("../../templates/header.php"); 

?>


<div class="card">
    <div class="card-header">
        Productos
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

<div class="mb-3">
  <label for="" class="form-label">ID</label>
  <input type="text"
    class="form-control" readonly name="txtID" id="txtID" value="<?php echo $txtID;?>" aria-describedby="helpId" placeholder="">
</div>


<div class="mb-3">
  <label for="imagen" class="form-label">Imagen</label>
  <img width="75"src="../../../assets/img/team/<?php echo $imagen;?>" />
  <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
</div>


<div class="mb-3">
  <label for="nombrecompleto" class="form-label">Nombre</label>
  <input type="text"
    class="form-control" value="<?php echo $nombrecompleto;?>" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombres completos">
</div>


<div class="mb-3">
  <label for="puesto" class="form-label">Puesto</label>
  <input type="text"
    class="form-control" value="<?php echo $puesto;?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
</div>


<div class="mb-3">
  <label for="urltwitter" class="form-label">Twitter</label>
  <input type="text"
    class="form-control" value="<?php echo $urltwitter;?>" name="urltwitter" id="urltwitter" aria-describedby="helpId" placeholder="urltwitter">
</div>


<div class="mb-3">
  <label for="urlfacebook" class="form-label">Facebook</label>
  <input type="text"
    class="form-control" value="<?php echo $urlfacebook;?>" name="urlfacebook" id="urlfacebook" aria-describedby="helpId" placeholder="urlfacebook">
</div>

<div class="mb-3">
  <label for="urllinkedin" class="form-label">Linkedin</label>
  <input type="text"
    class="form-control" value="<?php echo $urllinkedin;?>" name="urllinkedin" id="urllinkedin" aria-describedby="helpId" placeholder="urllinkedin">
</div>


<button type="submit" class="btn btn-success">Actualizar</button>


<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


</form>

    </div>
    <div class="card-footer text-muted">
  
    </div>
</div>


<?php include("../../templates/footer.php"); ?>