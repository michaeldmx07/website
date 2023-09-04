<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){

    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia=$conexion ->prepare("DELETE FROM tbl_mensajes WHERE id=:id ");
    $sentencia ->bindParam(":id",$txtID);
    $sentencia ->execute();

}

$sentencia=$conexion ->prepare("SELECT * FROM `tbl_mensajes`");
$sentencia->execute();
$lista_mensajes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">

    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del cliente</th>
                    <th scope="col">Correo electronico del cliente</th>
                    <th scope="col">Numero celular</th>
                    <th scope="col">Solicitud</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_mensajes as $registros){ ?>
                <tr class="">
                    <td scope="col"><?php echo $registros['ID'];?></td>
                    <td scope="col"><?php echo $registros['nombre'];?></td>
                    <td scope="col"><?php echo $registros['correoelectronico'];?></td>
                    <td scope="col"><?php echo $registros['numero'];?></td>
                    <td scope="col"><?php echo $registros['mensaje'];?></td>

                    <td>
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