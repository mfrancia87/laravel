<?php

//requires
require '../includes/operacionesBD.php';

$nick = filter_input(INPUT_POST, "nick");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$nombre = filter_input(INPUT_POST, "nombre");
$apellido = filter_input(INPUT_POST, "apellido");
$fechaNacimiento = date('Y-m-d', strtotime($_POST['fechaNac']));
$nombreEmpresa = filter_input(INPUT_POST, "nombreEmpresa");
$linkEmpresa = filter_input(INPUT_POST, "linkEmpresa");

if($_FILES["imagen"]["error"] > 0){
    echo "Error: " . $_FILES["imagen"]["error"] . "<br>";
}
else{
    //$directorio = "C:/wamp64/www/tareaPHP/img/perfil/";
    $directorio = "/tareaPHP/img/perfil/";
    $temp = explode(".", $_FILES["imagen"]["name"]);
    $nombreImg = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . $nombreImg);
    /* otros controles de archivo
    echo "Type: " . $_FILES["imagen"]["type"] . "<br>";
    echo "Size: " . ($_FILES["imagen"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["imagen"]["tmp_name"];
     */
}


$conexion = conectarBD();

$existeUsuario = existeUsuario($conexion, $email);

if($existeUsuario){
    echo '<p>Ya existe ese usuario. Intentelo de nuevo</p>';
}
else{
    if(empty($nombreEmpresa)){
        
    //registramos un cliente
        
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario (nick, email, password, nombre, apellido, fechaNacimiento, imagen, esProveedor) VALUES ('$nick', '$email', '$passHash', '$nombre', '$apellido', '$fechaNacimiento', '$directorio$nombreImg', false)";

        $result = mysqli_query( $conexion, $query );
            if($result){
                //agregado. redirijo a inicio
                header( "Location: ../index.php" );
            }else{
                echo "Error aca: ". $query ."<br>" . mysqli_error($conexion);
            }
    }
    else{
        
        //registramos un proveedor
        
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario (nick, email, password, nombre, apellido, fechaNacimiento, imagen, esProveedor) VALUES ('$nick', '$email', '$passHash', '$nombre', '$apellido', '$fechaNacimiento', '$directorio$nombreImg', true)";

        $result = mysqli_query( $conexion, $query );
            if($result){
                $idUsuario = mysqli_insert_id($conexion);
                $query2 = "INSERT INTO proveedor (idUsuario, nombreEmpresa, linkEmpresa) VALUES ('$idUsuario', '$nombreEmpresa', '$linkEmpresa')";
                $result2 = mysqli_query( $conexion, $query2 );
                if($result2){
                    header( "Location: ../index.php" );
                }
                else{
                    die("Error aca: ". $query2 ."<br>" . mysqli_error($conexion));
                }
                
            }else{
                die("Error aca: ". $query ."<br>" . mysqli_error($conexion));
            }
    }
}

desconectarBD($conexion);



