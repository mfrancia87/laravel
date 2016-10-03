<?php require '../templates/header.php';?>

<?php
    $nombre = filter_input(INPUT_POST, "nombre");
    $apellido = filter_input(INPUT_POST, "apellido");
    $biografia = filter_input(INPUT_POST, "biografia");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    
    //imagen
    $nombre_archivo = $_FILES["imagen"]["name"];  
    $tipo_archivo = $_FILES["imagen"]["type"];  
    $tamano_archivo = $_FILES["imagen"]["size"]; 
    
    $errores = "Se detectaron los siguientes errores:<br>";
    $usuarioValido = true;
    
    if (!preg_match("/^[a-zA-Z ]*$/",$nombre)){
        $errores .= "El nombre debe estar compuesto unicamente por letras<br>"; 
        $usuarioValido = false;
    }
    if(strlen($nombre)>20){
        $errores .= "El nombre debe tener un largo menor a 20 caracteres<br>";
        $usuarioValido = false;
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$apellido)){
        $errores .= "El apellido debe estar compuesto unicamente por letras<br>"; 
        $usuarioValido = false;
    }
    if(empty($biografia)){
        $errores .= "La biografia no puede ser vacia<br>";
        $usuarioValido = false;
    }
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
        $errores .= "El mail ingresado no es valido<br>";
        $usuarioValido = false;
    }
    
    if(strlen($password)<6){
        $errores .= "La contrasenia debe tener mas de 6 caracteres<br>";
        $usuarioValido = false;
    }
    
    //validacion imagen (puede ser null)
    
    $nom_img= $email; 
    $directorio = '../img/'; 
    
    if($usuarioValido && move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio . "/" . $nom_img)){
        //se registra en BD
        $conexionBD = mysqli_connect('localhost', 'root', 'root', 'login');
        if(!$conexionBD){
            die("No se pudo conectar con la BD ".mysqli_connect_error());
        }
        
        $query = "INSERT INTO usuarios (nombre, apellido, biografia, email, contrasenia, ruta_imagen) VALUES ('$nombre', '$apellido', '$biografia', '$email', '$password', '$nom_img');";
        if(mysqli_query($conexionBD, $query)){
?>
            <h3>Se ha registrado correctamente!</h3>
            <a href="../index.php">Volver</a>
<?php  
        mysqli_close($conexionBD);
        }
        else{
            die("No se pudo INSERTAR DATOS EN LA BD ".  mysqli_error($conexionBD));
        }
    }
    else{
?>
        <p><?php echo $errores;?></p>
        <h3>Sus datos son incorrectos. Intentelo nuevamente.</h3>
        <a href="../index.php">Volver</a>
<?php
    }
?>

<?php require '../templates/footer.php';?>
