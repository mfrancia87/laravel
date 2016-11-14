<?php

//requires
require '../includes/operacionesBD.php';

$nick = validarInput(filter_input(INPUT_POST, "nick"));         //agregado validarInput
$password = validarInput(filter_input(INPUT_POST, "pass"));     //agregado validarInput

$conexion = conectarBD();

$queryNick = "SELECT * from usuario WHERE nick='$nick'";
$resultado = mysqli_query($conexion, $queryNick);
if(count(mysqli_num_rows($resultado))==1){
    $tupla = mysqli_fetch_array($resultado);
        if (password_verify($password, $tupla["password"])) {
            //se loguea
            
            session_start();
            $_SESSION["idUsuario"] = $tupla["id"];
            $_SESSION["nick"]=$tupla["nick"];
            $_SESSION["nombre"]=$tupla["nombre"];
            $_SESSION["email"]=$tupla["email"];
            $_SESSION["esProveedor"]=$tupla["esProveedor"];
            $_SESSION["plan"]=$tupla["tipoPlan"];
            
            echo "true";
            
        }
        else{
            echo "false";
        }
}
else{
    echo "false";
}

desconectarBD($conexion);