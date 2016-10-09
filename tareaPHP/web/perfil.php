<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
 $nick = $_SESSION["nick"];
 $conexion = conectarBD();
 $datosUsuario = getUsuarioByNick($conexion, $nick);
 
?>

<div class="panel panel-info">
  <div class="panel-heading">Mi perfil:</div>
  <div class="panel-body">
    
  <form method="post" action="../phpScripts/actualizarPerfil.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nick">Nick:</label>
        <input type="text" class="form-control" name="nick" value="<?php echo $datosUsuario["nick"]; ?>" required>
    </div>
    <div class="form-group">
        <img src="<?php echo $datosUsuario["imagen"] ?>" height="200px">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo $datosUsuario["email"]; ?>"required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosUsuario["nombre"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" name="apellido" value="<?php echo $datosUsuario["apellido"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="fechaNac">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="fechaNac" value="<?php echo $datosUsuario["fechaNacimiento"]; ?>" required>
    </div>
  
    <?php
        if($_SESSION["esProveedor"]==true){
    ?>
        <div id="datosEmpresa" class="form-group">
            <label for="nombreEmpresa">Nombre de la empresa:</label>
            <input type="text" class="form-control" name="nombreEmpresa" value="<?php echo $datosUsuario["nombreEmpresa"]; ?>">
            <label for="linkEmpresa">Link:</label>
            <input type="text" class="form-control" name="linkEmpresa" value="<?php echo $datosUsuario["linkEmpresa"]; ?>">
        </div>
    <?php
        }
    ?>
      <button type="submit" class="btn btn-success">Actualizar</button>
      <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="../index.php">Cancelar</a></button>
    </form>
  </div>
</div>

<?php
 require '../includes/footer.php';
 ?>