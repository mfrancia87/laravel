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

//devuelve un usuario(buscado por su id)
function getUsuarioById($conexionBD, $id){
    $query = "SELECT * from usuario WHERE id='$id'";
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
        actualizarProveedor($conexionBD, $datos);
    }
    //si es cliente
    else{
        actualizarCliente($conexionBD, $datos);
    }
}    

//actualiza perfil de cliente
function actualizarCliente($conexionBD, $datos){
    $nick = $datos[1];
    $email = $datos[2];
    $nombre = $datos[3];
    $apellido = $datos[4];
    $fechaNacimiento = $datos[5];
    $directorio = $datos[6];
    $nombreImg = $datos[7];
    $idUsuario = $datos[8];
    
    if($directorio==NULL || $nombreImg==NULL){
        $query = "UPDATE usuario SET nick = '$nick', email = '$email', nombre = '$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento' WHERE id = '$idUsuario'";
        $result = mysqli_query( $conexionBD, $query );
        if($result){
            //modificado. redirijo a inicio
            header( "Location: ../index.php" );
        }
        else{
            echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
        }
    }
    else{
        $query = "UPDATE usuario SET nick = '$nick', email = '$email', nombre = '$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento', imagen = '$directorio$nombreImg' WHERE id = '$idUsuario'";
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

//actualiza perfil de proveedor
function actualizarProveedor($conexionBD, $datos){
    $nick = $datos[1];
    $email = $datos[2];
    $nombre = $datos[3];
    $apellido = $datos[4];
    $fechaNacimiento = $datos[5];
    $directorio = $datos[6];
    $nombreImg = $datos[7];
    $nombreEmpresa = $datos[8];
    $linkEmpresa = $datos[9];
    $idUsuario = $datos[10];
        
    if($directorio == NULL || $nombreImg == NULL){
        $query = "UPDATE usuario SET nick = '$nick', email = '$email', nombre = '$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento' WHERE id = '$idUsuario'";
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
        $query = "UPDATE usuario SET nick = '$nick', email = '$email', nombre = '$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento', imagen = '$directorio$nombreImg' WHERE id = '$idUsuario'";
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
}

//cambiar el plan del usuario
function cambiarPlanUsuario($conexionBD, $idUsuario, $planNuevo){
    $query = "UPDATE usuario SET tipoPlan = '$planNuevo' WHERE id = '$idUsuario'";
    $result = mysqli_query( $conexionBD, $query );
    if($result){
        //modificado. redirijo a inicio
        unset($_SESSION["plan"]);
        $_SESSION["plan"]=$planNuevo;
        header( "Location: ../index.php" );
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}


//devuelve array con precio de los planes registrados
function preciosPlanes($conexionBD){
    $precios = [];
    $query = "SELECT precio from suscripcion order by id asc";
    $result = mysqli_query( $conexionBD, $query );
    if($result){
        while($tupla = mysqli_fetch_array($result)){
            array_push($precios, $tupla[0]);
        }
        return $precios;
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}


function actualizarPreciosPlanes($conexionBD, $precioSilver, $precioGold){
    $query = "UPDATE suscripcion SET precio = CASE nombre
                WHEN 'silver' THEN '$precioSilver'
                WHEN 'gold' THEN '$precioGold'
                END
                WHERE nombre IN ('silver', 'gold')";
    $result = mysqli_query( $conexionBD, $query );
    if($result){
        //modificado. redirijo a inicio
        header( "Location: ../index.php" );
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}

//devuelve un arreglo con los clientes registrados en el sistema
function listarClientes($conexionBD){
    $query = "SELECT * FROM usuario WHERE esProveedor = false";
    $result = mysqli_query( $conexionBD, $query );
    $clientes = [];
    if($result){
        if(mysqli_num_rows($result)>0){
            //devuelvo el array
            while($tupla = mysqli_fetch_array($result)){
                array_push($clientes, $tupla);
            }
            return $clientes;
        }
        else{
            return NULL;
        }
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}


//devuelve un arreglo con los proveedores registrados en el sistema
function listarProveedores($conexionBD){
    $query = "SELECT * FROM usuario WHERE esProveedor = true";
    $result = mysqli_query( $conexionBD, $query );
    $proveedores = [];
    if($result){
        if(mysqli_num_rows($result)>0){
            //devuelvo el array
            while($tupla = mysqli_fetch_array($result)){
                array_push($proveedores, $tupla);
            }
            return $proveedores;
        }
        else{
            return NULL;
        }
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}

function listarCategorias($conexionBD){
    $query = "SELECT * FROM categoria WHERE idCategoriaPadre IS NULL";
    $result = mysqli_query( $conexionBD, $query );
    $categorias = [];
    if($result){
        //devuelvo el array
        while($tupla = mysqli_fetch_array($result)){
            array_push($categorias, $tupla);
        }
        return $categorias;
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}


function encontrarHijos($conexionBD, $idPadre){
    $query = "SELECT * FROM categoria WHERE idCategoriaPadre = '$idPadre'";
    $result = mysqli_query( $conexionBD, $query );
    $categorias = [];
    if($result){
        if(mysqli_num_rows($result)>0){
            //devuelvo el array
            while($tupla = mysqli_fetch_array($result)){
                array_push($categorias, $tupla);
            }
            return $categorias;
        }
        else{
            return NULL;
        }
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}

//lista los recursos de determinado proveedor
function listarRecursos($conexion, $idProveedor){
    $query = "SELECT * FROM recurso WHERE idProveedor = '$idProveedor'";
    $result = mysqli_query( $conexion, $query );
    $recursos = [];
    if($result){
        if(mysqli_num_rows($result)>0){
            //devuelvo el array
            while($tupla = mysqli_fetch_array($result)){
                array_push($recursos, $tupla);
            }
            return $recursos;
        }
        else{
            return NULL;
        }
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexion);
    }
}

//lista los recursos obtenidos por determinado cliente
function listarRecursosObtenidos($conexion, $idCliente){
    $query = "SELECT idRecurso FROM recursoscliente WHERE idUsuario = '$idCliente'";
    $result = mysqli_query( $conexion, $query );
    $listaIds = [];
    $recursos = [];
    $i = 0;
    if($result){
        if(mysqli_num_rows($result)>0){
            //devuelvo el array
            while($tupla = mysqli_fetch_array($result)){
                array_push($listaIds, $tupla);
            }
            return obtenerRecursosDeLista($conexion, $listaIds);
        }
        else{
            return NULL;
        }
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexion);
    }
}

function obtenerRecursosDeLista($conexion, $listaIds){
    $listaRecursos = [];
    foreach ($listaIds as $id) {
        $recurso = getRecursoById($conexion, $id[0]);
        array_push($listaRecursos, $recurso);
    }
    return $listaRecursos;
}


//lista todos los recursos del sistema
function listarTodosRecursos($conexion){
    $query = "SELECT * FROM recurso";
    $result = mysqli_query( $conexion, $query );
    $recursos = [];
    if($result){
        if(mysqli_num_rows($result)>0){
            //devuelvo el array
            while($tupla = mysqli_fetch_array($result)){
                array_push($recursos, $tupla);
            }
            return $recursos;
        }
        else{
            return NULL;
        }
    }
    else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexion);
    }
}

function agregarRecurso($conexionBD, $datosRecurso){
    $query = "INSERT INTO recurso (idProveedor, nombre, descripcion, imagen, tipoRecurso, tipoPlan, esDescargable, archivo) VALUES ('$datosRecurso[0]', '$datosRecurso[1]', '$datosRecurso[2]', '$datosRecurso[3]$datosRecurso[4]', '$datosRecurso[5]', '$datosRecurso[6]', '$datosRecurso[7]', '$datosRecurso[8]$datosRecurso[9]')";

    $result = mysqli_query($conexionBD, $query );
        if($result){
            //agregado. redirijo a inicio
            header( "Location: ../web/misRecursosPublicados.php" );
        }else{
            echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
        }
}


function getRecursoById($conexionBD, $idRecurso){
    $query = "SELECT * FROM recurso WHERE id = '$idRecurso'";
    $result = mysqli_query($conexionBD, $query) or die("Error en query: ". mysqli_error($conexionBD));
    $cantidad = mysqli_num_rows($result);
    if($cantidad==1){
        $tupla = mysqli_fetch_array($result);
        return $tupla;
    }
    else{
        return NULL;
    }
}

function modificarRecurso($conexionBD, $datosRecurso){
    $query = "UPDATE recurso SET nombre = '$datosRecurso[1]', descripcion = '$datosRecurso[2]', tipoRecurso = '$datosRecurso[3]', tipoPlan = '$datosRecurso[4]', esDescargable = '$datosRecurso[5]' WHERE id = '$datosRecurso[0]'";
    
    $result = mysqli_query($conexionBD, $query );
        if($result){
            //agregado. redirijo a inicio
            header( "Location: ../web/misRecursosPublicados.php" );
        }else{
            echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
        }
}


function comprarRecurso($conexionBD, $idCliente, $idRecurso, $idProveedor){
    $query = "INSERT INTO recursoscliente (idUsuario, idRecurso, idProveedor) VALUES ('$idCliente', '$idRecurso', '$idProveedor')";

    $result = mysqli_query($conexionBD, $query);
    if($result){
        //agregado. redirijo a inicio
        header( "Location: ../web/misRecursosObtenidos.php" );
    }else{
        echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
    }
}



function desconectarBD($conexionBD){
    mysqli_close($conexionBD);
}