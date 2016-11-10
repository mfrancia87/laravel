<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';

$idRecurso = filter_input(INPUT_GET, "id");
$idCliente = $_SESSION["idUsuario"];
$conexion = conectarBD();

$datosRecurso = getRecursoById($conexion, $idRecurso);
$idProveedor = $datosRecurso[1];

if($datosRecurso != NULL){

  if($datosRecurso[5]=="articulo" || $datosRecurso[5]=="libro" || $datosRecurso[5]=="revista"){
?>


<div class="panel panel-info">
  <div class="panel-heading">Vista de recurso: <?php echo $datosRecurso[2] ?></div>
  <div class="panel-body">
  <div class="col-lg-8 col-sm-8 col-xs-12">
      <iframe id="iframe" src="<?php echo $datosRecurso[8]."#toolbar=0"; ?>" height="400px" width="100%"></iframe>
  </div>
  <div class="col-lg-4 col-sm-4 col-xs-12">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosRecurso[2]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="tipoRecurso">Tipo de recurso:</label>
        <input type="text" class="form-control" name="tipoRecurso" value="<?php echo $datosRecurso[5]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" rows="5" name="descripcion" readonly><?php echo $datosRecurso[3]; ?></textarea>
    </div>
    
      <a class="btn btn-success center-block" style="text-decoration: none; color: white; white-space: normal; margin: 0 10px;" href="/tareaPHP/web/iframeFullScreen.php?rec=<?php echo $datosRecurso[8]; ?>">Ver fullscreen</a>
  </div>
  </div>
</div>


<?php
  }
  if($datosRecurso[5]=="video"){
?>
    
<div class="panel panel-info">
  <div class="panel-heading">Vista de recurso: <?php echo $datosRecurso[2] ?></div>
  <div class="panel-body">
  <div class="col-lg-8 col-sm-8 col-xs-12">
      <video width="400" height="250" controls>
        <source src="<?php echo $datosRecurso[8]; ?>" type="video/mp4">
      </video>
  </div>
  <div class="col-lg-4 col-sm-4 col-xs-12">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosRecurso[2]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="tipoRecurso">Tipo de recurso:</label>
        <input type="text" class="form-control" name="tipoRecurso" value="<?php echo $datosRecurso[5]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" rows="5" name="descripcion" readonly><?php echo $datosRecurso[3]; ?></textarea>
    </div>
  </div>
  </div>
</div>

<?php
  }
}
else{
    echo "No hay nada";
}


require '../includes/footer.php';

desconectarBD($conexion);
 
?>

<script>

$(function(){
    
    
});

</script>

<style>

    .full{
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

</style>