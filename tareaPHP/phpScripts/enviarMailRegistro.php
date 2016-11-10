<?php

//para el registro
$email = filter_input(INPUT_GET, "email");
$nombre = filter_input(INPUT_GET, "nombre");
$tipo = filter_input(INPUT_GET, "tipo");


//para probar en el menu principal
/*
$email="proffrancia@gmail.com";
$nombre="Mathias";
$tipo="proveedor";
*/

$titulo = "Bienvenido a Taller PHP";

$mensaje = "<html><body style='height: 220px; width: 80%; margin: auto; font-family: rockwell; border: 4px double blue; border-radius: 10px; padding: 5px 10px;'>".
        "<h1 style='text-align: center; background-color: blue; color: white;'>Bienvenido $nombre</h1>".
        "<h2>Usted se ha registrado en la plataforma como $tipo en Taller PHP 2016.</h2>".
        "<h3>Lo saluda atentamente:</h3>".
        "<h3>El equipo de desarrollo de PHP</h3>".
        "<a href='http://localhost/tareaPHP/index.php'><button style='background-color: blue; font-family: Arial Black; border-radius: 10px; cursor: pointer; color: white; width: 200px'>Ir a la plataforma</button></a>".
        "</body></html>";

$cabezal = 'MIME-Version: 1.0' . "\r\n";
$cabezal .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$cabezal .= 'From: Tarea PHP <tareaphp2016@gmail.com>' . "\r\n";

mail($email, $titulo, $mensaje, $cabezal);

header( "Location: ../index.php" );
?>

<!-- vista previa
<html>
    <body style="height: 220px; width: 80%; margin: auto; font-family: rockwell; border: 4px double blue; border-radius: 10px; padding: 5px 10px;">
        <h1 style="text-align: center; background-color: blue; color: white;">Bienvenido <?php echo $nombre; ?></h1>
        <h2>Usted se ha registrado en la plataforma como <?php echo $tipo; ?> en Taller PHP 2016.</h2>
        <h3>Lo saluda atentamente:</h3>
        <h3>El equipo de desarrollo de PHP</h3>
        <a href="http://localhost/tareaPHP/index.php"><button style="background-color: blue; font-family: Arial Black; border-radius: 10px; cursor: pointer; color: white; width: 200px">Ir a la plataforma</button></a>
    </body>
</html>
 
-->

