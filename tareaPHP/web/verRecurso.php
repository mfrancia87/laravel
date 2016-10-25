<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idRecurso = filter_input(INPUT_GET, "id");
if(isset($_SESSION["idUsuario"])){
    $idCliente = $_SESSION["idUsuario"];
}
else{
    $idCliente = NULL;
}

$conexion = conectarBD();
$recurso = getRecursoById($conexion, $idRecurso);
$yaLoCompro = verificarCompraRecurso($conexion, $idCliente, $idRecurso);

if($recurso != NULL){
?>

<div class="panel panel-info">
    <div class="panel-heading">Recurso: <strong><?php echo "$recurso[2]" ?> </strong></div>
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
    <input name="link" type="hidden" value="<?php echo $recurso[8]; ?>">
    <?php
    if(isset($_SESSION["idUsuario"])){
    ?>
    <input name="idCliente" type="hidden" value="<?php echo $_SESSION["idUsuario"]; ?>">
    <input name="planCliente" type="hidden" value="<?php echo $_SESSION["plan"] ?>">
    <?php
    }
    
    if(isset($_SESSION["idUsuario"]) && $_SESSION["idUsuario"]!=1){
        if(!$yaLoCompro){
    ?>
      <button type="submit" class="btn btn-success">Obtener recurso</button>     
    <?php 
        }
      }
    ?>
      
  </div>
  </form>
      <?php
      if($yaLoCompro){
          ?>
          <button class="btn btn-success pull-right"><a style="text-decoration: none; color: white;" href="<?php echo $recurso[8];?>" download>Descargar</a></button>
      <?php
          }
      ?>
      
      
  </div>
</div>
<?php
}
else{
    ?>
    <div class="panel panel-danger">
        <div class="panel-heading">Recurso no encontrado</div>
        <div class="panel-body">
      <?php
            echo "<h3>El recurso seleccionado no existe. Inténtelo nuevamente</h3>";
        
    ?>
        </div>
    </div>

    <script>
    $(function(){
        var delay = 3000; //milisegundos
        var pagina = "../index.php";
        setTimeout(function(){ 
            window.location = pagina; 
        }, delay);
    });
    </script>


<?php
}
    



require '../includes/footer.php';