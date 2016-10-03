<?php require '../includes/header.php';

 require '../includes/menuNav.php';
?>

<form action="../phpScripts/registroScript.php" enctype="multipart/form-data">
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
        
        
        
    });
</script>

<?php
 require '../includes/footer.php';
 ?>