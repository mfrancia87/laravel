<?php
session_start();

//si no está logueado o si no es cliente
if(!isset($_SESSION["idUsuario"]) || $_SESSION["esProveedor"]!=0){
    header("Location: ../index.php");
}

require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$idCliente = $_SESSION["idUsuario"];
$listaRecursos = listarRecursosObtenidos($conexion, $idCliente);


?>

<div class="table-responsive">
    <?php
        if($listaRecursos != NULL){
    ?>
    <table id="recursosObtenidos" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo de recurso</th>
            <th>Para plan:</th>
            <th>Ver más</th>
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
            <td><a href="verRecurso.php?id=<?php echo $recurso[0] ?>" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
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
                <h3>Usted no ha obtenido recursos aún</h3>
            </div>
        </div>
</div> <!-- body container -->
    <?php
        }
        
        require '../includes/footer.php';
    ?>
