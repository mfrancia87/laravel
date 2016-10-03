<?php

//requires
require '../includes/operacionesBD.php';

$nick = filter_input(INPUT_POST, "nick");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$nombre = filter_input(INPUT_POST, "nombre");
$apellido = filter_input(INPUT_POST, "apellido");
$fechaNacimiento = date('Y-m-d', strtotime($_POST['fechaNac']));
$imagen = NULL;
$nombreEmpresa = filter_input(INPUT_POST, "nombreEmpresa");
$linkEmpresa = filter_input(INPUT_POST, "linkEmpresa");


$conexion = conectarBD();

$existeUsuario = existeUsuario($conexion, $email);

if($existeUsuario){
    echo '<p>Ya existe ese usuario. Intentelo de nuevo</p>';
}
else{
    if(empty($nombreEmpresa)){
        
    //registramos un cliente
        
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario (nick, email, password, nombre, apellido, fechaNacimiento, imagen, esProveedor) VALUES ('$nick', '$email', '$passHash', '$nombre', '$apellido', '$fechaNacimiento', '$imagen', false)";

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
        $query = "INSERT INTO usuario (nick, email, password, nombre, apellido, fechaNacimiento, imagen, esProveedor) VALUES ('$nick', '$email', '$passHash', '$nombre', '$apellido', '$fechaNacimiento', '$imagen', true)";

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



