<?php

//requires
require '../includes/operacionesBD.php';

$nick = filter_input(INPUT_POST, "nick");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$nombre = filter_input(INPUT_POST, "nombre");
$apellido = filter_input(INPUT_POST, "apellido");
$fechaNacimiento = NULL;
//$fechaNacimiento = date('Y-m-d', strtotime($_POST['fechaNac']));
$imagen = NULL;


$conexion = conectarBD();

$existeUsuario = buscarUsuario($conexion, $email);

if($existeUsuario){
    echo '<p>Ya existe ese usuario. Intentelo de nuevo</p>';
}
else{
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO usuario (nick, email, password, nombre, apellido, fechaNacimiento, imagen) VALUES ('$nick', '$email', '$passHash', '$nombre', '$apellido', '$fechaNacimiento', '$imagen')";
    
    $result = mysqli_query( $conexion, $query );
        if($result){
            //echo '<p>Agregado correctamente</p>';
            header( "Location: ../index.php" );
        }else{
            echo "Error: ". $query ."<br>" . mysqli_error($conexion);
        }
}



