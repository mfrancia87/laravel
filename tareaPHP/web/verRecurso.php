<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idRecurso = filter_input(INPUT_GET, "id");
$idProveedor = filter_input(INPUT_GET, "idProveedor");

$conexion = conectarBD();
$recurso = getRecursoById($conexion, $idRecurso);

if($recurso != NULL){
?>

<div class="panel panel-info">
    <div class="panel-heading">Recurso: <strong><?php echo "$recurso[1]" ?> </strong></div>
  <div class="panel-body">
    
  <form method="post" action="../phpScripts/comprarRecurso.php">
  
  <div class="col-lg-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <img style="display: block; margin: auto" src="<?php echo $recurso[4] ?>" height="200px" class="img-rounded" align="middle">
        </div>
  </div>
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $recurso[2]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" rows="5" name="descripcion" readonly><?php echo $recurso[3] ; ?></textarea>
    </div>
    <div class="form-group">
        <label for="tipoRecurso">Tipo recurso:</label>
        <input type="text" class="form-control" name="tipoRecurso" value="<?php echo $recurso[5]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="tipoPlan">Tipo plan:</label>
        <input type="text" class="form-control" name="tipoPlan" value="<?php echo $recurso[6]; ?>" readonly>
    </div>
    <input name="idRecurso" type="hidden" value="<?php echo $recurso[0]; ?>">
    <input name="idProveedor" type="hidden" value="<?php echo $recurso[1]; ?>">
    <?php
        if(!empty($idProveedor)){
    ?>
      <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="verProveedorConRecursos.php?id=<?php echo $idProveedor; ?>">Volver</a></button>
    <?php
        }else{
    ?>
      <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="listarRecursos.php">Volver</a></button>
    <?php
      }
      if($_SESSION["esProveedor"]==false && $_SESSION["idUsuario"]!=1){
    ?>
      <button type="submit" class="btn btn-success">Obtener recurso</button>     
    <?php
      }
    ?>
  </div>
    
      
    </form>
  </div>
</div>
<?php
}
else{
    echo "<h3>El recurso seleccionado no existe. Inténtelo nuevamente</h3>";
    header( "refresh:5;url=verProveedorConRecursos.php" );
}