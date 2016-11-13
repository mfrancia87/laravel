<?php
session_start();

//si no está logueado o si no es proveedor
if(!isset($_SESSION["idUsuario"]) || $_SESSION["esProveedor"]!=1){
    header("Location: ../index.php");
}


require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$idProveedor = $_SESSION["idUsuario"];
$listaRecursos = listarRecursos($conexion, $idProveedor);


?>

<div class="table-responsive">
    <?php
        if($listaRecursos != NULL){
    ?>
    <table id="recursosPublicados" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo de recurso</th>
            <th>Para plan:</th>
            <th>Editar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($listaRecursos as $recurso) {
          ?>
            <tr class="clickable-row">
            <td><?php echo "$recurso[2]" ?></td>
            <td><?php echo "$recurso[3]" ?></td>
            <td><?php echo "$recurso[5]" ?></td>
            <td><?php echo "$recurso[6]" ?></td>
            <td><a href="editarRecurso.php?id=<?php echo $recurso[0] ?>" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>
          </tr>
          <?php
            }
          
          ?>
          
        </tbody>
    </table>
 </div>
    <?php
        }
        else{
    ?>
        <div class="panel panel-info">
            <div class="panel-heading">No se encontraron recursos</div>
            <div class="panel-body">
                <h1>Usted no ha publicado recursos aún</h1>
            </div>
        </div>
    <?php
        }
    ?>


<div class="form-group">
    <button class="btn btn-success"><a style="text-decoration: none; color: white" href="../web/crearRecurso.php">Crear nuevo recurso</a></button>
</div>

</div>
<?php
require '../includes/footer.php';