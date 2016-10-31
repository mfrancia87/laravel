<?php
require '../includes/operacionesBD.php';

$correo = filter_input(INPUT_POST, "emailVerificar");


$conexion = conectarBD();

$query = "SELECT * from usuario WHERE email='$correo'";
$result = mysqli_query($conexion, $query) or die("Error en query: ". mysqli_error($conexion));
$cantidad = mysqli_num_rows($result);
if($cantidad>0){
    echo "true";
}
else{
    echo "false";
}