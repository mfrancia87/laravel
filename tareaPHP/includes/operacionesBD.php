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
function existeUsuario($conexionBD, $nick){
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

//devuelve un usuario(buscado por su nick)
function getUsuarioByNick($conexionBD, $nick){
    $query = "SELECT * from usuario WHERE nick='$nick'";
    $result = mysqli_query($conexionBD, $query) or die("Error en query: ". mysqli_error($conexionBD));
    $cantidad = mysqli_num_rows($result);
    if($cantidad==1){
        $tupla = mysqli_fetch_array($result);
        if($tupla["esProveedor"]==true){
            $idUsuario = $tupla["id"];
            $query = "select * from proveedor where idUsuario = $idUsuario";
            $result = mysqli_query($conexionBD, $query);
            $tuplaProveedor = mysqli_fetch_array($result);
            $tupla = array_merge($tupla, $tuplaProveedor);
        }
        return $tupla;
    }
    else{
        return NULL;
    }
}

function actualizarUsuarioByNick($conexionBD, $datos){
    //si es proveedor
    if($datos[0]==true){
        $nick = $datos[1];
        $email = $datos[2];
        $nombre = $datos[3];
        $apellido = $datos[4];
        $fechaNacimiento = $datos[5];
        $imagen = $datos[6];
        $nombreEmpresa = $datos[7];
        $linkEmpresa = $datos[8];
        $idUsuario = $datos[9];
        $query = "UPDATE usuario SET nick = '$nick', email = '$email', nombre = '$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento', imagen = '$imagen' WHERE id = '$idUsuario'";
        $result = mysqli_query( $conexionBD, $query );
        if($result){
            //modificado. cambio la tabla proveedor
            $query2 = "UPDATE proveedor SET nombreEmpresa = '$nombreEmpresa', linkEmpresa = '$linkEmpresa' WHERE idUsuario = '$idUsuario'";
            $result2 = mysqli_query( $conexionBD, $query2 );
            if($result2){
                //modificado. redirijo a index
                header( "Location: ../index.php" );
            }
            else{
                echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
            }
        }
        else{
            echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
        }
    }
    else{
        //si es cliente
        $nick = $datos[1];
        $email = $datos[2];
        $nombre = $datos[3];
        $apellido = $datos[4];
        $fechaNacimiento = $datos[5];
        $imagen = $datos[6];
        $idUsuario = $datos[7];
        $query = "UPDATE usuario SET nick = '$nick', email = '$email', nombre = '$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento', imagen = '$imagen' WHERE id = '$idUsuario'";
        $result = mysqli_query( $conexionBD, $query );
        if($result){
            //modificado. redirijo a inicio
            header( "Location: ../index.php" );
        }
        else{
            echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
        }
    }
}

function desconectarBD($conexionBD){
    mysqli_close($conexionBD);
}