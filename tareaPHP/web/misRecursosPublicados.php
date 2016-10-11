<?php
session_start();
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
    <table id="recursos" class="table table-bordered table-hover">
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
    <?php
        }
        else{
            echo "<h3>Aún no has agregado ningún recurso</h3>";
        }
    ?>
</div>

<div class="form-group">
    <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="../web/crearRecurso.php">Crear nuevo recurso</a></button>
</div>

  
<script>
    /*
    $(function(){
        $('#recursos').on('click', '.clickable-row', function() {
            alert("hiciste clic en un recurso con");
          });

    });
*/
</script>

