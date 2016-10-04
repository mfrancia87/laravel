<?php

//requires
require '../includes/operacionesBD.php';

$precioSilver = filter_input(INPUT_POST, "silver");
$precioGold = filter_input(INPUT_POST, "gold");

$conexion = conectarBD();

actualizarPreciosPlanes($conexion, $precioSilver, $precioGold);

desconectarBD($conexion);