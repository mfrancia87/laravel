<?php

//requires
require '../includes/operacionesBD.php';

$nombre = filter_input(INPUT_POST, "nombre");
$tipoArticulo = filter_input(INPUT_POST, "tipoRecurso");
$descripcion = filter_input(INPUT_POST, "descripcion");
$plan = filter_input(INPUT_POST, "plan");
$checkbox = filter_input(INPUT_POST, "esDescargable");

if(isset($checkbox)){
    $esDescargable = true;
}
else{
    $esDescargable = false;
}

if($_FILES["imagen"]["error"] > 0){
    echo "Error: " . $_FILES["imagen"]["error"] . "<br>";
}
else{
    //$directorio = "C:/wamp64/www/tareaPHP/img/recurso/";
    $directorio = "../img/recurso/";
    $temp = explode(".", $_FILES["imagen"]["name"]);
    $nombreImg = round(microtime(true)) . '.' . end($temp);
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . $nombreImg)){
        echo "SUBIDO";
    } else {
       echo "EL ARCHIVO NO SE SUBIO";
    }
    /* otros controles de archivo
    echo "Type: " . $_FILES["imagen"]["type"] . "<br>";
    echo "Size: " . ($_FILES["imagen"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["imagen"]["tmp_name"];
     */
}

//archivo

$conexion = conectarBD();

echo $nombre."<br>";
echo $tipoArticulo."<br>";
echo $descripcion."<br>";
echo $nombre."<br>";
echo $plan."<br>";