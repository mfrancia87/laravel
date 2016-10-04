<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$listaClientes = listarClientes($conexion);


?>

<div class="table-responsive">
    <table class="table">
        <thead>
          <tr>
            <th>Nick</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>E-mail</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($listaClientes as $cliente) {
          ?>
            <tr>
            <td><?php echo "$cliente[1]" ?></td>
            <td><?php echo "$cliente[4]" ?></td>
            <td><?php echo "$cliente[5]" ?></td>
            <td><?php echo "$cliente[2]" ?></td>
          </tr>
          <?php
          }
          ?>
          
        </tbody>
</table>