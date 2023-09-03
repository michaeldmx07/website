<?php 
include("../../bd.php");

// Aqui llamamos a traves de un txtID a un numero identificador de cada producto para eliminarlo
if(isset($_GET['txtID'])){

    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    //Consulta para borrar la imagen a traves del nombre.
    $sentencia=$conexion ->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id ");
    $sentencia ->bindParam(":id",$txtID);
    $sentencia ->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/team/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/team/".$registro_imagen["imagen"]);
        }
    }

    

    $sentencia=$conexion ->prepare("DELETE FROM tbl_equipo WHERE id=:id ");
    $sentencia ->bindParam(":id",$txtID);
    $sentencia ->execute();

}

//Aqui estoy llamando los datos de la base local para mostrar 
$sentencia=$conexion ->prepare("SELECT * FROM `tbl_equipo`");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">

    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Twitter</th>
                    <th scope="col">Facebook</th>
                    <th scope="col">Linkedin</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_portafolio as $registros){ ?>
                <tr class="">
                    <td scope="col"><?php echo $registros['ID'];?></td>
                    <td scope="col"><img width="50"src="../../../assets/img/team/<?php echo $registros['imagen'];?>" /></td>
                    <td scope="col"><?php echo $registros['nombrecompleto'];?></td>
                    <td scope="col"><?php echo $registros['puesto'];?></td>
                    <td scope="col"><?php echo $registros['urltwitter'];?></td>
                    <td scope="col"><?php echo $registros['urlfacebook'];?></td>
                    <td scope="col"><?php echo $registros['urllinkedin'];?></td>

                    <td>
                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                    <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    

    </div>

</div>

<?php include("../../templates/footer.php"); ?>