<?php 

session_start();

require 'includes/header.php';
require 'includes/menuNav.php';
require 'includes/operacionesBD.php';
 
?>


<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px;">

  <!-- imagenes -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
        <img src="img/sitio/1.jpg" alt="imagen 1">
    </div>

    <div class="item">
        <img src="img/sitio/2.jpg" alt="imagen 2">
    </div>

    <div class="item">
        <img src="img/sitio/3.jpg" alt="imagen 3">
    </div>
  </div>

  <!-- controles -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previa</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>



<?php
/*
if(isset($_SESSION["nombre"])){
    echo "<h2>Bienvenido ".$_SESSION["nombre"]."</h2>";
    if($_SESSION["esProveedor"]==false && $_SESSION["idUsuario"]== 1){
        echo '<p>Ud es administrador</p>';
    }
    if($_SESSION["esProveedor"]==false && $_SESSION["idUsuario"]!= 1){
        echo '<p>Ud es cliente</p>';
    }
    if($_SESSION["esProveedor"]==true){
        echo '<p>Ud es proveedor</p>';
    }
}
*/



 
$conexion = conectarBD();
$listaRecursos = listarTodosRecursos($conexion);


if($listaRecursos != NULL){
?>
<div class="row">
<?php
    foreach ($listaRecursos as $recurso) {
    ?>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
         <div class="panel panel-info" style="height: 300px;">
            <div class="panel-heading"><strong><?php echo "$recurso[2]" ?> </strong></div>
            <div class="panel-body">
        
                <div class="form-group" style="width: 80%; margin: auto;">
                  <img style="display: block; width: 100%; margin: auto" src="<?php echo $recurso[4] ?>" height="100px" class="img-rounded" align="middle">
                </div>
        
          <div class="form-group">
              <label for="tipoPlan">Tipo plan:</label>
              <input type="text" class="form-control" name="tipoPlan" value="<?php echo $recurso[6]; ?>" readonly>
          </div>
            </div>
            <a class="btn btn-success center-block" style="text-decoration: none; color: white; white-space: normal; margin: 0 10px;" href="/tareaPHP/web/verRecurso.php?id=<?php echo $recurso[0]; ?>">Ver recurso</a>
            
            
        </div>
    </div>
    <?php
    }
    ?>
</div>
<?php
}
else{
    ?>
    <div class="panel panel-danger">
        <div class="panel-heading">Recurso no encontrado</div>
        <div class="panel-body">
            <h3>No hay recursos agregados aún</h3>
        </div>
    </div>

<?php
}




desconectarBD($conexion);

require 'includes/footer.php';

?>
