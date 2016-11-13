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
$nombreEmpresa = filter_input(INPUT_POST, "nombreEmpresa");
$linkEmpresa = filter_input(INPUT_POST, "linkEmpresa");

//manejo de imagen
$directorio = "../img/perfil/";
if(isset($_FILES["imagen"])&& ($_FILES["imagen"]['size'] > 0)){
    $temp = explode(".", $_FILES["imagen"]["name"]);
    $nombreImg = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . $nombreImg);
}
else{
    $directorio = NULL;
    $nombreImg = NULL;
}


$conexion = conectarBD();
$datosUsuario = [];

if($_SESSION["esProveedor"]==true){
    array_push($datosUsuario, true, $nick, $email, $nombre, $apellido, $fechaNacimiento, $directorio, $nombreImg, $nombreEmpresa, $linkEmpresa, $idUsuario);
}
else{
    array_push($datosUsuario, false, $nick, $email, $nombre, $apellido, $fechaNacimiento, $directorio, $nombreImg, $idUsuario);
}

actualizarUsuarioByNick($conexion, $datosUsuario);
$_SESSION["nick"]= $nick;
$_SESSION["email"]= $email;

desconectarBD($conexion);