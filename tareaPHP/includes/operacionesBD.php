<?php



function conectarBD(){
    $servidor = "localhost";
    $usuario = "root";
    $pass = "root";
    $bd = "tareaphp";
    $conexionBD = mysqli_connect($servidor, $usuario, $pass, $bd);

    if(!$conexionBD){
        die("Fallo la conexion".mysqli_connect_error());
    }
    else {
        return $conexionBD;
    }
}

//chequeamos que ya no este registrado el mismo mail
function buscarUsuario($conexionBD, $nick){
    $query = "select * from usuario where nick = $nick";
    $result = mysqli_query($conexionBD, $query);
    $cantidadTuplas = mysqli_num_rows($result);
    if($cantidadTuplas > 0){
        return true;
    }
    else{
        return false;
    }
}

function desconectarBD(){
    mysqli_close($conexionBD);
}