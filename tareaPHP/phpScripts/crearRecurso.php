<?php
session_start();

//requires
require '../includes/operacionesBD.php';

$idProveedor = $_SESSION["idUsuario"];
$nombre = filter_input(INPUT_POST, "nombre");
$descripcion = filter_input(INPUT_POST, "descripcion");
$tipoRecurso = filter_input(INPUT_POST, "tipoRecurso");
$tipoPlan = filter_input(INPUT_POST, "plan");
$checkbox = filter_input(INPUT_POST, "esDescargable");
$listaCategorias = [];


foreach($_POST['categoria'] as $check) {
    array_push($listaCategorias, $check);
}


if(isset($checkbox)){
    $esDescargable = true;
}
else{
    $esDescargable = false;
}


//manejo de imagen
$directorio = "../img/recurso/";

if(($_FILES["imagen"]["error"] > 0) || ($_FILES['imagen']['error'] == UPLOAD_ERR_NO_FILE)){
    //echo "Error: " . $_FILES["imagen"]["error"] . "<br>";
    $nombreImg = "default.jpg";
}

else{
    $temp = explode(".", $_FILES["imagen"]["name"]);
    $nombreImg = round(microtime(true)) . '.' . end($temp);
    
    /* otros controles de archivo
    echo "Type: " . $_FILES["imagen"]["type"] . "<br>";
    echo "Size: " . ($_FILES["imagen"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["imagen"]["tmp_name"];
     */
}

//manejo de archivo
if($_FILES["archivo"]["error"] > 0){
    echo "Error: " . $_FILES["archivo"]["error"] . "<br>";
    //header( "refresh:5;url=../index.php" );
}
else{
    $directorioArchivo = "../archivos/recursos/";
    $temp = explode(".", $_FILES["archivo"]["name"]);
    $nombreArchivo = round(microtime(true)) . '.' . end($temp);
}


$conexion = conectarBD();

$datosRecurso = [];
$directorioImg = "/tareaPHP/img/recurso/";
array_push($datosRecurso, $idProveedor, $nombre, $descripcion, $directorioImg, $nombreImg, $tipoRecurso, $tipoPlan, $esDescargable, $directorioArchivo, $nombreArchivo);

if($_FILES['imagen']['error'] == UPLOAD_ERR_NO_FILE){
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $directorioArchivo . $nombreArchivo)){
        agregarRecurso($conexion, $datosRecurso);
        $idRecurso = mysqli_insert_id($conexion);
        agregarCategoriasArecurso($conexion, $idRecurso, $listaCategorias);
        
        //agregado. redirijo a mis recursos publicados
        header( "Location: ../index.php" );
    }
    else{
        echo "<p>No se pudo subir el archivoooooo</p>";
    }
}
else{
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . $nombreImg) && (move_uploaded_file($_FILES["archivo"]["tmp_name"], $directorioArchivo . $nombreArchivo))){
        agregarRecurso($conexion, $datosRecurso);
        $idRecurso = mysqli_insert_id($conexion);
        agregarCategoriasArecurso($conexion, $idRecurso, $listaCategorias);
        
        //agregado. redirijo a mis recursos publicados
        header( "Location: ../index.php" );
    }
    else{
        echo "<p>No se pudo subir el archivo</p>";
    }
}




desconectarBD($conexion);
 
 