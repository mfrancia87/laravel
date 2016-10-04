<?php
session_start();
//requires
require '../includes/operacionesBD.php';

$planNuevo = filter_input(INPUT_POST, "planNuevo");
$idUsuario = $_SESSION["idUsuario"];
$id = filter_input(INPUT_POST, "id");
$conexion = conectarBD();

cambiarPlanUsuario($conexion, $idUsuario, $planNuevo);



desconectarBD($conexion);