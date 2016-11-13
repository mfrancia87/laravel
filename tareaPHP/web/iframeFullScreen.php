<?php

session_start();
//si no está logueado
if(!isset($_SESSION["idUsuario"])){
    header("Location: ../index.php");
}


$recurso = filter_input(INPUT_GET, "rec");

?>
<html>
    <iframe src="<?php echo $recurso."#toolbar=0"; ?>" height="100%" width="100%"></iframe>
</html>


