<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$listaProveedores = listarProveedores($conexion);


?>

<div class="table-responsive">
    <?php
        if($listaProveedores != NULL){
    ?>
    <table id="clientes" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nick</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>E-mail</th>
            <th>Ver detalles</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($listaProveedores as $proveedor) {
          ?>
            <tr class="clickable-row">
            <td><?php echo "$proveedor[1]" ?></td>
            <td><?php echo "$proveedor[4]" ?></td>
            <td><?php echo "$proveedor[5]" ?></td>
            <td><?php echo "$proveedor[2]" ?></td>
            <td><a href="verProveedorConRecursos.php?id=<?php echo $proveedor[0] ?>" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a></td>
          </tr>
          <?php
          }
          ?>
          
        </tbody>
    </table>
    <?php
        }
        else{
            echo "<h3>Aún no se ha registrado ningún proveedor</h3>";
        }
    ?>
</div>