<?php 

session_start();

require 'includes/header.php';
require 'includes/menuNav.php';
require 'includes/operacionesBD.php';
 
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
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
         <div class="panel panel-info" style="height: 300px;">
            <div class="panel-heading"><strong><?php echo "$recurso[2]" ?> </strong></div>
            <div class="panel-body">
        
                <div class="form-group" style="width: 80%; margin: auto;">
                  <img style="display: block; margin: auto" src="<?php echo $recurso[4] ?>" height="100px" class="img-rounded" align="middle">
                </div>
        
          <div class="form-group">
              <label for="tipoPlan">Tipo plan:</label>
              <input type="text" class="form-control" name="tipoPlan" value="<?php echo $recurso[6]; ?>" readonly>
          </div>
            </div>
            <button class="btn btn-danger center-block"><a style="text-decoration: none; color: white; white-space: normal;" href="/tareaPHP/web/verRecurso.php?id=<?php echo $recurso[0]; ?>">Ver recurso</a></button>
            
            
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
      <?php
        echo "<h3>No hay recursos agregados aún</h3>";
        header( "refresh:5;url=../index.php" );
        
    ?>
        </div>
    </div>

<?php
}




desconectarBD($conexion);

require 'includes/footer.php';

?>

<style>

.panel-heading{
    font-family: Impact !important;
}
    
</style>