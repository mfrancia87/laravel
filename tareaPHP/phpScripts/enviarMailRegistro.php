<?php
//session_start();
//para el registro
$email = filter_input(INPUT_GET, "email");
$nombre = filter_input(INPUT_GET, "nombre");
$tipo = filter_input(INPUT_GET, "tipo");

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


require '../includes/header.php';

require '../includes/menuNav.php';
?>


<?php
mail($email, $titulo, $mensaje, $cabezal);
?>
<div class="panel panel-success">
  <div class="panel-heading">¡Registro exitoso!</div>
  <div class="panel-body">
      <h2>Registro exitoso</h2>
      <h3>Ya puedes iniciar sesión con tu cuenta</h3>
      <h3>Redirigiendo a inicio...</h3>
  </div>
</div>


<script>
window.onload = function(){
    var delay = 2000; //milisegundos
    var pagina = "../index.php";
    setTimeout(function(){ 
        window.location = pagina; 
    }, delay);
};
</script>
<?php

require '../includes/footer.php';

