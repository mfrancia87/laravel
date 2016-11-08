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

if($planRecurso == "free" || $planCliente == "gold" || strcmp($planRecurso, $planCliente)==0){

    if($esDescargable == 1){    //si se puede descargar
?>

        <div class="panel panel-info">
          <div class="panel-heading">Editar recurso:</div>
          <div class="panel-body">
              <h3>Recurso obtenido</h3>
              <h5>Aquí está su link</h5>
              <button class="btn btn-success"><a style="text-decoration: none; color: white;" href="<?php echo $link;?>" download>Descargar</a></button>
          </div>
        </div>
        <?php
        comprarRecurso($conexion, $idCliente, $idRecurso, $idProveedor);
     }
     else{      //si solo se puede ver online
?>
    <span class="label label-warning">Este recurso no es descargable</span>
    <a class="btn btn-success center-block" style="text-decoration: none; color: white; white-space: normal; margin: 0 10px; width: 200px;" href="/tareaPHP/web/vistaPreviaRecurso.php?id=<?php echo $idRecurso; ?>">Ver recurso online</a>
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