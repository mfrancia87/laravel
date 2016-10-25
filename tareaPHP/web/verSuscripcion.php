<?php 

session_start();
require '../includes/header.php';
require '../includes/menuNav.php';
         
 if(isset($_SESSION["plan"])){
    $planUsuario = $_SESSION["plan"];
}
require '../includes/operacionesBD.php';

$conexion = conectarBD();
$preciosPlanes = preciosPlanes($conexion);

$free = "<span><strong><h3>FREE</h3></strong><h5>Completamente gratuito!!</h5></span>";
$silver = "<span><strong><h3>SILVER</h3></strong><h5>$preciosPlanes[1] USD por mes</h5></span>";
$gold = "<span><strong><h3>GOLD</h3></strong><h5>$preciosPlanes[2] USD por mes</h5></span>";

?>


<div class="panel panel-info">
  <div class="panel-heading">Cambiar mi plan:</div>
  <h3 style="text-align: center;">Usted cuenta con el plan <strong><?php echo "$planUsuario"; ?></strong></h3>
  <div class="panel-body">
      <h4 style="text-align: center;">Contamos con las siguientes ofertas:</h4>
    
        <div class="panel panel-info col-lg-4 col-md-4 col-xs-12 " style="cursor: pointer;">
            <img id="free" class="center-block" src="../img/sitio/free.png" style="height: 200px; cursor: pointer;">
            <div style="text-align: center"><?php echo $free;?></div>
        </div>
        <div class="panel panel-info col-lg-4 col-md-4 col-xs-12">
            <img id="silver" class="center-block" src="../img/sitio/silver.png" style="height: 200px; cursor: pointer;">
            <div style="text-align: center"><?php echo $silver;?></div>
        </div>
        <div class="panel panel-info col-lg-4 col-md-4 col-xs-12">
            <img id="gold" class="center-block" src="../img/sitio/gold.png" style="height: 200px; cursor: pointer;">
            <div style="text-align: center"><?php echo $gold;?></div>
        </div>
    
        <form method="post" action="../phpScripts/cambiarSuscripcion.php" enctype="multipart/form-data">
            <input id="planNuevo" name="planNuevo" type="text" hidden>
            <button id="cambiarPlan" type="submit" class="btn btn-success pull-right">Cambiar de plan</button>
        </form>
      
  </div>
</div>

<script>
    $(function(){
        $('.center-block').on("click", function(){
            var plan = $(this).attr("id");
            
            $('#planNuevo').attr("value", plan);
            
            $(this).parent().css("border", "5px red solid");
            
            $('.center-block').not($(this)).parent().css("border", "1px black solid");
        });
    });
</script>
