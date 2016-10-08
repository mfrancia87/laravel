<?php

//requires
require '../includes/operacionesBD.php';

$nombre = filter_input(INPUT_POST, "nombre");
$idPadre = filter_input(INPUT_POST, "id");

$conexion = conectarBD();


if(empty($idPadre)){
    $query = "INSERT INTO categoria (nombre) VALUES ('$nombre')";

    $result = mysqli_query($conexion, $query);
    if($result){
        //categoria agregada. redirijo a inicio
        header( "Location: ../web/gestionarCategorias.php" );
    }else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexion);
    }
}
else{
    $query = "INSERT INTO categoria (nombre, idCategoriaPadre) VALUES ('$nombre', '$idPadre')";

    $result = mysqli_query($conexion, $query);
    if($result){
        //categoria agregada. recargo pagina
        header( "Location: ../web/gestionarCategorias.php" );
    }else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexion);
    }
}


desconectarBD($conexion);