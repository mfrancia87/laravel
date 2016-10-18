<?php 

session_start();
require 'includes/header.php';
require 'includes/menuNav.php';

 
 
if(isset($_SESSION["nombre"])){
    echo "<h2>Bienvenido ".$_SESSION["nombre"]."</h2>";
    if($_SESSION["esProveedor"]==false && $_SESSION["idUsuario"]== 1){
        echo '<p>Ud es administrador</p>';
    }
    if($_SESSION["esProveedor"]==false && $_SESSION["idUsuario"]!= 1){
        echo '<p>Ud es cliente</p>';
    }
    if($_SESSION["esProveedor"]==true){
        echo '<p>Ud es proveedor</p>';
    }
}



require 'includes/footer.php';
?>


