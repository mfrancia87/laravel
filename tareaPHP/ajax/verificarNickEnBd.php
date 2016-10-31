<?php
require '../includes/operacionesBD.php';

$nick = filter_input(INPUT_POST, "nickVerificar");


$conexion = conectarBD();

$query = "SELECT * from usuario WHERE nick='$nick'";
$result = mysqli_query($conexion, $query) or die("Error en query: ". mysqli_error($conexion));
$cantidad = mysqli_num_rows($result);
if($cantidad>0){
    echo "true";
}
else{
    echo "false";
}
