<?php
require '../includes/operacionesBD.php';
session_start();
$nick = filter_input(INPUT_POST, "nickVerificar");
$nickUsuario = $_SESSION["nick"];

$conexion = conectarBD();

$query = "SELECT * from usuario WHERE nick='$nick'";
$result = mysqli_query($conexion, $query) or die("Error en query: ". mysqli_error($conexion));
$tupla = mysqli_fetch_array($result);
$cantidad = mysqli_num_rows($result);
if($cantidad>0){
    if($tupla[1]==$nickUsuario){
        echo "false";
    }
    else{
        echo "true";
    }
}
else{
    echo "false";
}
