<?php

$mail = filter_input(INPUT_GET, "mail");

  $conexionBD = mysqli_connect('localhost', 'root', 'root', 'login');
  if(!$conexionBD){
      die("No se pudo conectar con la BD".mysqli_connect_error());
  }
  $queryMail = "SELECT imagen from usuarios WHERE email='$mail'";
  $resultado = mysqli_query($conexionBD, $queryMail);
  $fila = mysqli_fetch_array($resultado);
  mysqli_close($conexionBD);

  header("Content-type: image/jpeg");
  echo $fila['imagen'];
?>
