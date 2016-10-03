<?php require '../includes/header.php';

 require '../includes/menuNav.php';
?>

<form method="post" action="../phpScripts/registroScript.php" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="tipoUsuario">Ud se registrará como:</label>
        <label class="radio-inline"><input type="radio" name="tipoUsuario" value="cliente" checked>Cliente</label>
        <label class="radio-inline"><input type="radio" name="tipoUsuario" value="proveedor">Proveedor</label>
    </div>
    
    <div class="form-group">
        <label for="nick">Nick:</label>
        <input type="text" class="form-control" name="nick" required>
    </div>
     <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
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
    
    <button type="submit" class="btn btn-default">Registrarme!</button>
</form>


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
        
        
    });
</script>

<?php
 require '../includes/footer.php';
 ?>