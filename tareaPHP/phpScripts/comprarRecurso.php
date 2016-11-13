<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idRecurso = filter_input(INPUT_POST, "idRecurso");
$idProveedor = filter_input(INPUT_POST, "idProveedor");
$planRecurso = filter_input(INPUT_POST, "tipoPlan");
$tipoRecurso = filter_input(INPUT_POST, "tipoRecurso");
$idCliente = filter_input(INPUT_POST, "idCliente");
$planCliente = filter_input(INPUT_POST, "planCliente");
$esDescargable = filter_input(INPUT_POST, "esDescargable");
$link = filter_input(INPUT_POST, "link");


$conexion = conectarBD();
$recurso = getRecursoById($conexion, $idRecurso);
$yaLoCompro = verificarCompraRecurso($conexion, $idCliente, $idRecurso);


if($planRecurso == "free" || $planCliente == "gold" || strcmp($planRecurso, $planCliente)==0){
    if(!$yaLoCompro){
        comprarRecurso($conexion, $idCliente, $idRecurso, $idProveedor);
        enviarMailCompraRecurso($conexion, $idRecurso, $idCliente);
    }
    if($esDescargable == 1){    //si se puede descargar
?>
        <div class="panel panel-info">
          <div class="panel-heading">Obtener recurso:</div>
          <div class="panel-body">
              <h3>Recurso obtenido</h3>
              <h5>Aquí está su descarga <?php echo $link; ?></h5>
              <button class="btn btn-success"><a style="text-decoration: none; color: white;" href="<?php echo $recurso[8];?>" download>Descargar</a></button>
          </div>
        </div>
        <?php
     }
     else{      //si solo se puede ver online
?>
        <div class="panel panel-info">
          <div class="panel-heading">Obtener recurso:</div>
          <div class="panel-body">
              <h3>Recurso obtenido</h3>
              <span class="label label-warning" style="font-size: 20px;">Este recurso no es descargable</span>
              <h5>Aquí está su link</h5>
              <a class="btn btn-success center-block" style="text-decoration: none; color: white; white-space: normal; margin: 0 10px; width: 200px;" href="/tareaPHP/web/vistaPreviaRecurso.php?id=<?php echo $idRecurso; ?>">Ver recurso online</a>
          </div>
        </div>
<?php
     }
}
else{
?>

<div class="panel panel-danger">
  <div class="panel-heading">Error:</div>
  <div class="panel-body">
      <h3>Usted no puede obtener este recurso</h3>
      <h5>Para obtener este recurso, cambie su suscripción a <?php echo "$planRecurso";?></h5>
  </div>
</div>

<script>
$(function(){
    var delay = 3000; //milisegundos
    var pagina = "../web/VerSuscripcion.php";
    setTimeout(function(){ 
        window.location = pagina; 
    }, delay);
});
</script>


<?php
}


desconectarBD($conexion);

require '../includes/footer.php';