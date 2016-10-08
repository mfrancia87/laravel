<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$listaClientes = listarClientes($conexion);


?>

<div class="table-responsive">
    <table id="clientes" class="table table-bordered table-hover">
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
            <tr class="clickable-row">
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
</div>
    
    
    <script>
        $(function(){
            $('#clientes').on('click', '.clickable-row', function(event) {
                alert("hiciste clic en un cliente");
              });
            
        });
    
    </script>