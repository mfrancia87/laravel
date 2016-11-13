<?php
require '../includes/operacionesBD.php';
session_start();
$correo = filter_input(INPUT_POST, "emailVerificar");
$correoUsuario = $_SESSION["email"];

$conexion = conectarBD();

$query = "SELECT * from usuario WHERE email='$correo'";
$result = mysqli_query($conexion, $query) or die("Error en query: ". mysqli_error($conexion));
$tupla = mysqli_fetch_array($result);
$cantidad = mysqli_num_rows($result);
if($cantidad>0){
    if($tupla[2]==$correoUsuario){
        echo "false";
    }
    else{
        echo "true";
    }
}
else{
    echo "false";
}