<?php
require '../includes/operacionesBD.php';


$conexion = conectarBD();
$tipos = [];

$query = "SELECT nick, id FROM usuario WHERE esProveedor = true";
$result = mysqli_query( $conexion, $query );
$proveedores = [];
$idProveedores = [];
if($result){
    if(mysqli_num_rows($result)>0){
        //devuelvo el array
        while($tupla = mysqli_fetch_array($result)){
            array_push($proveedores, $tupla[0]);
            array_push($idProveedores, $tupla[1]);
            array_push($tipos, "Proveedor");
        }
    }
    else{
        $proveedores = NULL;
        $idProveedores = NULL;
        $tipos = NULL;
    }
}
else{
    echo "Error aca: ". $query ."<br>" . mysqli_error($conexionBD);
}



$query2 = "SELECT nombre, id FROM recurso";
$result2 = mysqli_query( $conexion, $query2 );
$recursos = [];
$idRecursos = [];
if($result2){
    if(mysqli_num_rows($result2)>0){
        //devuelvo el array
        while($tupla2 = mysqli_fetch_array($result2)){
            array_push($recursos, $tupla2[0]);
            array_push($idRecursos, $tupla2[1]);
            array_push($tipos, "Recurso");
        }
    }
    else{
        $recursos = NULL;
        $idRecursos = NULL;
        $tipos = NULL;
    }
}
else{
    echo "Error aca: ". $query2 ."<br>" . mysqli_error($conexion);
}



$proveedoresYrecursos = array_merge($proveedores, $recursos);
$ids = array_merge($idProveedores, $idRecursos);

$resultado = [];
$resultado['proveedoresYrecursos'] = $proveedoresYrecursos;
$resultado['ids'] = $ids;
$resultado['tipos'] = $tipos;

echo json_encode($resultado);
 
