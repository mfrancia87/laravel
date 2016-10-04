<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$preciosPlanes = preciosPlanes($conexion);

?>

<div class="panel panel-info">
  <div class="panel-heading">Actualizar precios:</div>
  <div class="panel-body">
      <form method="post" action="../phpScripts/actualizarPreciosSuscripciones.php">
        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
            <label for="silver">Suscripción <strong>SILVER</strong>:</label>
            <input type="number" step="0.01" class="form-control" name="silver" value="<?php echo $preciosPlanes[1]; ?>" required>
        </div>
         <div class="form-group col-lg-6 col-sm-6 col-xs-12">
            <label for="gold">Suscripción <strong>GOLD</strong>:</label>
            <input type="number" step="0.01" class="form-control" name="gold" value="<?php echo $preciosPlanes[2]; ?>"required>
        </div>
      <button type="submit" class="btn btn-success">Actualizar precios</button>
      <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="../index.php">Cancelar</a></button>
    </form>
  </div>
</div>