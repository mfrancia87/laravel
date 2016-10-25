<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idProveedor = filter_input(INPUT_GET, "id");

$conexion = conectarBD();
$datosProveedor = getUsuarioById($conexion, $idProveedor);
$recursosProveedor = listarRecursos($conexion, $idProveedor);

if($datosProveedor != NULL){
?>

<div class="panel panel-info">
    <div class="panel-heading">Proveedor: <strong><?php echo "$datosProveedor[1]" ?> </strong></div>
  <div class="panel-body">
    
  <form method="post" action="../phpScripts/actualizarRecurso.php" enctype="multipart/form-data">
  
  <div class="col-lg-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <img style="display: block; margin: auto" src="<?php echo $datosProveedor[7] ?>" height="200px" class="img-rounded" align="middle">
        </div>
  </div>
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <div class="form-group">
        <label for="nick">Nick:</label>
        <input type="text" class="form-control" name="nick" value="<?php echo $datosProveedor[1]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" value="<?php echo $datosProveedor[2]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosProveedor[4]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" name="apellido" value="<?php echo $datosProveedor[5]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="nombreEmpresa">Nombre de la empresa:</label>
        <input type="text" class="form-control" name="nombreEmpresa" value="<?php echo $datosProveedor[11]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="linkEmpresa">Link de la empresa:</label>
        <input type="text" class="form-control" name="linkEmpresa" value="<?php echo $datosProveedor[12]; ?>" readonly>
    </div>
  
      
    <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="listarProveedores.php">Volver</a></button>
  </div>
    
      
    </form>
  </div>
</div>

<div class="panel panel-info">
        <div class="panel-heading">Recursos adquiridos por <strong><?php echo "$datosProveedor[1]" ?> </strong></div>
        <div class="panel-body">
<div class="table-responsive">
    <?php
        if($recursosProveedor != NULL){
    ?>
    <table id="recursos" class="table table-bordered table-hover">
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
            foreach ($recursosProveedor as $recurso) {
          ?>
            <tr class="clickable-row">
            <td><?php echo "$recurso[2]" ?></td>
            <td><?php echo "$recurso[3]" ?></td>
            <td><?php echo "$recurso[5]" ?></td>
            <td><?php echo "$recurso[6]" ?></td>
            <td><a href="verRecurso.php?id=<?php echo $recurso[0] ?>" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a></td>
          </tr>
          <?php
            }
          
          ?>
          
        </tbody>
    </table>
 </div>
</div>
</div>
    <?php
        }
        else{
    ?>
    <div class="panel panel-danger">
        <div class="panel-heading">Recursos subidos por <strong><?php echo "$datosProveedor[1]" ?> </strong></div>
        <div class="panel-body">
        <?php
            echo "<h3>"."$datosProveedor[1]"." aún no ha agregado ningún recurso</h3>";
        }
        ?>
        </div>
    </div>

<?php
}
else{
    echo "<h3>El proveedor seleccionado no existe. Inténtelo nuevamente</h3>";
    header( "refresh:5;url=listarProveedores.php" );
}


require '../includes/footer.php';

desconectarBD($conexion);