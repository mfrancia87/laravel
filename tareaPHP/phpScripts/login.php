<?php require '../templates/header.php';?>

<?php

$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

$conexionBD = mysqli_connect('localhost', 'root', 'root', 'login');
if(!$conexionBD){
    die("No se pudo conectar con la BD".mysqli_connect_error());
}
$queryMail = "SELECT * from usuarios WHERE email='$email'";
$resultado = mysqli_query($conexionBD, $queryMail);
if(count(mysqli_num_rows($resultado))==1){
    $tupla = mysqli_fetch_array($resultado);
    if($tupla["email"]==$email){
        if($tupla["contrasenia"]==$password){
            $nombre = $tupla["nombre"];
            echo "<h2>Login exitoso!!</h2>";
            session_start();
            $_SESSION["nombre"]=$nombre;
            $_SESSION["mail"]=$email;
            echo "<br>".$_SESSION["nombre"];
        }
        else{
            echo "<h2>Password incorrecto. Intentelo nuevamente</h2>";
        }
    }
    else{
        echo "<h2>Email incorrecto. Intentelo nuevamente</h2>";
    }
}
else{
    echo "<h2>Nombre de usuario o password incorrecto. Intentelo nuevamente</h2>";
}

?>

<a href="../index.php">Volver</a>
<?php require '../templates/footer.php';?>