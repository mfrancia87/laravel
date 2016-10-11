<?php

session_start();
//requires
require '../includes/operacionesBD.php';

$idUsuario = $_SESSION["idUsuario"];


desconectarBD($conexion);