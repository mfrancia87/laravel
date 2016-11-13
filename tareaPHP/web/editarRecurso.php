<?php 
 session_start();
 
 //si no está logueado o si no es proveedor
if(!isset($_SESSION["idUsuario"]) || $_SESSION["esProveedor"]!=1){
    header("Location: ../index.php");
}


require '../includes/operacionesBD.php';
 
$idRecurso = filter_input(INPUT_GET, "id");
$conexion = conectarBD();
$datosRecurso = getRecursoById($conexion, $idRecurso);

//si el proveedor logueado no es el mismo que el dueño del recurso a editar
if($_SESSION["idUsuario"] != $datosRecurso[1]){
    header("Location: ../index.php");
}
 


require '../includes/header.php';
require '../includes/menuNav.php';

if($datosRecurso != NULL){
?>

<div class="panel panel-info">
  <div class="panel-heading">Editar recurso:</div>
  <div class="panel-body">
    
  <form method="post" action="../phpScripts/actualizarRecurso.php" enctype="multipart/form-data">
  
  <input type="hidden" class="form-control" name="id" value="<?php echo $datosRecurso[0]; ?>">
  <div class="col-lg-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <img style="display: block; margin: auto" src="<?php echo $datosRecurso[4] ?>" height="200px" class="img-rounded" align="middle">
        </div>
  </div>
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosRecurso[2]; ?>" required>
    </div>
    <div class="form-group">
        <label for="tipoRecurso">Tipo de recurso:</label>
        <select class="form-control" name="tipoRecurso">
            <option value="articulo">Artículo</option>
            <option value="revista">Revista</option>
            <option value="libro">Libro</option>
            <option value="video">Video</option>
        </select>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" rows="5" name="descripcion" required><?php echo $datosRecurso[3] ; ?></textarea>
    </div>
    <div class="form-group">
        <label for="plan">Disponible para plan:</label>
        <select class="form-control" name="plan">
            <option value="free">Free</option>
            <option value="silver">Silver</option>
            <option value="gold">Gold</option>
        </select>
    </div>
    <div class="checkbox">
        <label><input name="esDescargable" type="checkbox" value="si">Es descargable</label>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
  </div>
    
      
    </form>
  </div>
</div>
<?php
}
else{
?>
      <div class="panel panel-danger">
        <div class="panel-heading">Error:</div>
        <div class="panel-body">
            <h3>No se puede encontrar el recurso</h3>
            <h5>Inténtelo nuevamente</h5>
        </div>
      </div>
<?php
}


require '../includes/footer.php';

desconectarBD($conexion);