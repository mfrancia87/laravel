<?php require '../includes/header.php';

 require '../includes/menuNav.php';
?>

<div class="panel panel-info">
  <div class="panel-heading">Registro</div>
  <div class="panel-body">

<form method="post" action="../phpScripts/registroScript.php" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="tipoUsuario">Ud se registrará como:</label>
        <label class="radio-inline"><input type="radio" name="tipoUsuario" value="cliente" checked>Cliente</label>
        <label class="radio-inline"><input type="radio" name="tipoUsuario" value="proveedor">Proveedor</label>
    </div>
    
    <div class="form-group">
        <label for="nick">Nick:<span id="errorNick"></span></label>
        <input type="text" class="form-control" name="nick" id="nick" required>
    </div>
     <div class="form-group">
         <label for="email">Email:<span id="errorMail"></span></label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" name="apellido" required>
    </div>
    <div class="form-group">
        <label for="fechaNac">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="fechaNac" required>
    </div>
    <div id="checkImagen" class="checkbox">
        <label><input type="checkbox">Imagen de perfil?</label>
    </div>
    <div id="imagen" class="form-group">
        <label for="imagen">Foto de perfil:</label>
        <input type="file" class="form-control" name="imagen">
    </div>
    
    <div id="datosEmpresa" class="form-group">
        <label for="nombreEmpresa">Nombre de la empresa:</label>
        <input type="text" class="form-control" name="nombreEmpresa">
        <label for="linkEmpresa">Link:</label>
        <input type="text" class="form-control" name="linkEmpresa">
    </div>
    
    <button type="submit" class="btn btn-default" disabled="false">Registrarme!</button>
</form>
</div>
</div>

<script>
    $(function(){
        $('#imagen').hide();
        
        $('#checkImagen input[type=checkbox]').click(function(){
           if($(this).is(":checked")) {
               $('#imagen').show();
           }
           else{
               $('#imagen').hide();
           }
        });
        
        $('#datosEmpresa').hide();
        
        $('input[type="radio"]').click(function() {
            if($(this).attr('value') === 'proveedor') {
                 $('#datosEmpresa').show();           
            }
            else{
                $('#datosEmpresa :input').val('');
                $('#datosEmpresa').hide();   
            }
        });
        
        
        $('input[name=nick]').on("blur", function(){
            var nickVerificar = $('#nick').val();
            
            
            $.ajax({
                type:"POST",
                url: "/tareaPHP/ajax/verificarNickEnBd.php",
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
        
        $('input[name=email]').on("blur", function(){
            var emailVerificar = $('#email').val();
            
            
            $.ajax({
                type:"POST",
                url: "/tareaPHP/ajax/verificarCorreoEnBd.php",
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

<?php
 require '../includes/footer.php';
 ?>