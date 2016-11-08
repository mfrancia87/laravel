<?php

/* para el registro
$email = filter_input(INPUT_GET, "email");
$nombre = filter_input(INPUT_GET, "nombre");
$tipo = filter_input(INPUT_GET, "tipo");
*/

//para probar en el menu principal
$email="proffrancia@gmail.com";
$nombre="Mathias";
$tipo="proveedor";

$titulo = "Bienvenido a Taller PHP";
$mensaje = "<h3>Bienvenido $nombre</h3>\n<h4>Usted se ha registrado en la plataforma como $tipo en Taller PHP 2016.</h4>\n\nLo saluda atentamente:\n"
        . "\tEl equipo de desarrollo de PHP";

$cabeceras = 'From: tareaphp2016@gmail.com';

mail($email, $titulo, $mensaje, $cabeceras);

header( "Location: ../index.php" );