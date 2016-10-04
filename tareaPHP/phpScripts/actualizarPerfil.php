<?php
session_start();
//requires
require '../includes/operacionesBD.php';

$idUsuario = $_SESSION["idUsuario"];
$nick = filter_input(INPUT_POST, "nick");
$email = filter_input(INPUT_POST, "email");
$nombre = filter_input(INPUT_POST, "nombre");
$apellido = filter_input(INPUT_POST, "apellido");
$fechaNacimiento = date('Y-m-d', strtotime($_POST['fechaNac']));
$imagen = NULL;
$nombreEmpresa = filter_input(INPUT_POST, "nombreEmpresa");
$linkEmpresa = filter_input(INPUT_POST, "linkEmpresa");

$conexion = conectarBD();
$datosUsuario = [];

if($_SESSION["esProveedor"]==true){
    array_push($datosUsuario, true, $nick, $email, $nombre, $apellido, $fechaNacimiento, $imagen, $nombreEmpresa, $linkEmpresa, $idUsuario);
}
else{
    array_push($datosUsuario, false, $nick, $email, $nombre, $apellido, $fechaNacimiento, $imagen, $idUsuario);
}

actualizarUsuarioByNick($conexion, $datosUsuario);

desconectarBD($conexion);