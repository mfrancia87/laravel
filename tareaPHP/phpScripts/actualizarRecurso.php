<?php
session_start();

//requires
require '../includes/operacionesBD.php';

$idRecurso = filter_input(INPUT_POST, "id");
$nombre = filter_input(INPUT_POST, "nombre");
$descripcion = filter_input(INPUT_POST, "descripcion");
$tipoRecurso = filter_input(INPUT_POST, "tipoRecurso");
$tipoPlan = filter_input(INPUT_POST, "plan");
$checkbox = filter_input(INPUT_POST, "esDescargable");

$esDescargable = 0;
if(isset($checkbox)){
    $esDescargable = 1;
}


$conexion = conectarBD();

$datosRecurso = [];
array_push($datosRecurso, $idRecurso, $nombre, $descripcion, $tipoRecurso, $tipoPlan, $esDescargable);

modificarRecurso($conexion, $datosRecurso);

desconectarBD($conexion);