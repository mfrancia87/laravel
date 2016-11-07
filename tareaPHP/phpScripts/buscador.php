<?php
require '../includes/operacionesBD.php';


$conexion = conectarBD();

$palabra = filter_input(INPUT_POST, "palabra");
$tipo = filter_input(INPUT_POST, "tipo");
$id = filter_input(INPUT_POST, "id");

if($tipo == 'Proveedor'){
    header("location: ../web/verProveedorConRecursos.php?id=$id");
}
if($tipo == 'Recurso'){
    header("location: ../web/verRecurso.php?id=$id");
}
else{
    echo "<h3>No se encontro lo que buscabas</h3>";
}