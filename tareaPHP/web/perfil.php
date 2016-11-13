<?php 
 session_start();
 
 //si no está logueado
if(!isset($_SESSION["idUsuario"])){
    header("Location: ../index.php");
}
 
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
  <div class="col-lg-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <img style="display: block; margin: auto" src="<?php echo $datosUsuario["imagen"] ?>" height="200px" class="img-circle" align="middle">
        </div>
        <div class="form-group">
          <label for="imagen">Cambiar de foto:</label>
          <input type="file" class="form-control" name="imagen">
        </div>
    </div>
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <div class="form-group">
        <label for="nick">Nick:<span class="label" id="errorNick"></span></label>
        <input id="nick" type="text" class="form-control" name="nick" value="<?php echo $datosUsuario["nick"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:<span class="label" id="errorMail"></span></label>
        <input id="email" type="email" class="form-control" name="email" value="<?php echo $datosUsuario["email"]; ?>"required>
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
  </div>
    
      
    </form>
  </div>
</div>

<?php
 require '../includes/footer.php';
 
?> 
 

 <script>
    //VERIFICA EL NICK Y EL MAIL POR AJAX, PARA QUE NO SE REPITAN
    $(function(){
       
        $('#nick').on("blur", function(){
            var nickVerificar = $('#nick').val();
            
            
            $.ajax({
                type:"POST",
                url: "/tareaPHP/ajax/verificarNickActualizarPerfil.php",
                data:{"nickVerificar": nickVerificar},
                success:function(resp){
                    if(resp=="true"){
                        if(nickVerificar !== ''){
                            $('#nick').css("border", "2px solid red");
                            $('#errorNick').html("El nick ya está en uso").css({"background-color":"red", "color":"white"});
                            $('button').prop('disabled', true);
                        }
                    }
                    else{
                        if(nickVerificar !== ''){
                            $('#nick').css("border", "2px solid green");
                            $('#errorNick').html("El nick está disponible").css({"background-color":"green", "color":"white"});
                            $('button').prop('disabled', false);
                        }
                    }
                },
                error: function(jqXHR, estado, error){
                    console.log(estado);
                    console.log(error);
                },
                complete: function(jqXHR, estado){
				  console.log(estado);
				},
                timeout: 10000
            })
            
        });
        
        $('#email').on("blur", function(){
            var emailVerificar = $('#email').val();
            
            
            $.ajax({
                type:"POST",
                url: "/tareaPHP/ajax/verificarCorreoActualizarPerfil.php",
                data:{"emailVerificar": emailVerificar},
                success:function(resp){
                    if(resp=="true"){
                        if(emailVerificar !== ''){
                            $('#email').css("border", "2px solid red");
                            $('#errorMail').html("El mail ya está en uso").css({"background-color":"red", "color":"white"});
                            $('button').prop('disabled', true);
                        }
                    }
                    else{
                        if(emailVerificar !== ''){
                            $('#email').css("border", "2px solid green");
                            $('#errorMail').html("El mail está disponible").css({"background-color":"green", "color":"white"});
                            $('button').prop('disabled', false);
                        }
                    }
                },
                error: function(jqXHR, estado, error){
                    console.log(estado);
                    console.log(error);
                },
                complete: function(jqXHR, estado){
				  console.log(estado);
				},
                timeout: 10000
            })
        });
        
    });
</script>

