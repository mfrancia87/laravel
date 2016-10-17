<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idRecurso = filter_input(INPUT_POST, "idRecurso");
$idProveedor = filter_input(INPUT_POST, "idProveedor");
$planRecurso = filter_input(INPUT_POST, "tipoPlan");
$idCliente = $_SESSION["idUsuario"];
$planCliente = $_SESSION["plan"];

$conexion = conectarBD();

if($planRecurso == "free" || $planCliente == "gold" || strcmp($planRecurso, $planCliente)){

comprarRecurso($conexion, $idCliente, $idRecurso, $idProveedor);
?>

<div class="panel panel-info">
  <div class="panel-heading">Editar recurso:</div>
  <div class="panel-body">
      <h3>Recurso obtenido</h3>
      <h5>Descarga comenzando en instantes...</h5>
  
  </div>
</div>
<?php
}
else{
  
?>

<div class="panel panel-danger">
  <div class="panel-heading">Error:</div>
  <div class="panel-body">
      <h3>Usted no puede obtener este recurso</h3>
      <h5>Para obtener este recurso, cambie su suscripción a <?php echo "$planRecurso"; ?></h5>
      header( "refresh:4;url=verSuscripcion.php" );
  </div>
</div>
<?php
}


desconectarBD($conexion);
