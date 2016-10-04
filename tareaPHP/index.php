<?php 

session_start();
require 'includes/header.php';
 require 'includes/menuNav.php';

 
 
if(isset($_SESSION["nombre"])){
    echo "<h2>Bienvenido ".$_SESSION["nombre"];
    if($_SESSION["esProveedor"]==true){
        echo '<p>Ud es proveedor</p>';
    }
    else{
        echo '<p>Ud es cliente</p>';
    }
}
?>

<?php
 require 'includes/footer.php';
 ?>

