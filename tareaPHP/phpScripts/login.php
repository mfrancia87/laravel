<?php

//requires
require '../includes/operacionesBD.php';

$nick = filter_input(INPUT_POST, "nick");
$password = filter_input(INPUT_POST, "password");

$conexion = conectarBD();

$queryNick = "SELECT * from usuario WHERE nick='$nick'";
$resultado = mysqli_query($conexion, $queryNick);
if(count(mysqli_num_rows($resultado))==1){
    $tupla = mysqli_fetch_array($resultado);
        if (password_verify($password, $tupla["password"])) {
            //se loguea
            $nombre = $tupla["nombre"];
            $email = $tupla["email"];
            $esProveedor = $tupla["esProveedor"];
            $nick = $tupla["nick"];
            $idUsuario = $tupla["id"];
            session_start();
            $_SESSION["idUsuario"] = $idUsuario;
            $_SESSION["nick"]=$nick;
            $_SESSION["nombre"]=$nombre;
            $_SESSION["email"]=$email;
            $_SESSION["esProveedor"]=$esProveedor;
            echo "<br>".$_SESSION["nombre"];
            header( "Location: ../index.php" );
        }
        else{
            echo "<h2>Password incorrecto. Intentelo nuevamente</h2>";
        }
}
else{
    echo "<h2>Nombre de usuario o password incorrecto. Intentelo nuevamente</h2>";
}

desconectarBD($conexion);