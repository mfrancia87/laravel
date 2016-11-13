<?php
require '../includes/operacionesBD.php';


$conexion = conectarBD();

$palabra = filter_input(INPUT_POST, "buscar");
$tipo = filter_input(INPUT_POST, "tipo");
$id = filter_input(INPUT_POST, "id");

if(!empty($palabra)){
    if($tipo == 'Proveedor'){
        header("location: ../web/verProveedorConRecursos.php?id=$id");
    }
    if($tipo == 'Recurso'){
        header("location: ../web/verRecurso.php?id=$id");
    }
    if($tipo == 'Categoria'){
        //echo "<h3>Esta es  una categoria</h3>";
        header("location: ../web/verRecursosPorCategoria.php?id=$id");
    }
    if(empty($tipo)){
        header("location: ../web/busquedaIncorrecta.php");
    }
}
else{
    header("location: ../web/busquedaIncorrecta.php");
    //echo "<h3>No se encontro lo que buscabas</h3>";
}

 