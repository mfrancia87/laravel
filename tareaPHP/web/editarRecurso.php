<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idRecurso = filter_input(INPUT_GET, "id");
$conexion = conectarBD();
$datosRecurso = getRecursoById($conexion, $idRecurso);
if($datosRecurso != NULL){
?>

<div class="panel panel-info">
  <div class="panel-heading">Editar recurso:</div>
  <div class="panel-body">
    
  <form method="post" action="../phpScripts/actualizarRecurso.php" enctype="multipart/form-data">
  <div class="col-lg-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <img style="display: block; margin: auto" src="<?php echo $datosRecurso[4] ?>" height="200px" class="img-rounded" align="middle">
        </div>
    </div>
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosRecurso["nombre"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion:</label>
        <input type="text" class="form-control" name="email" value="<?php echo $datosRecurso["descripcion"]; ?>"required>
    </div>
    <div class="form-group">
        <label for="tipoRecurso">Tipo Recurso:</label>
        <input type="text" class="form-control" name="tipoRecurso" value="<?php echo $datosRecurso["tipoRecurso"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="tipoPlan">Tipo Plan:</label>
        <input type="text" class="form-control" name="tipoPlan" value="<?php echo $datosRecurso["tipoPlan"]; ?>" required>
    </div>
    
  
      <button type="submit" class="btn btn-success">Actualizar</button>
      <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="../index.php">Cancelar</a></button>
  </div>
    
      
    </form>
  </div>
</div>
<?php
}
else{
    echo "No hay nada";
}

desconectarBD($conexion);