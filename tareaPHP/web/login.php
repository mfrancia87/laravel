<?php require '../includes/header.php';

 require '../includes/menuNav.php';
?>

<form method="post" action="../phpScripts/login.php">
    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
        <label for="nick">Nick:</label>
        <input type="text" class="form-control" name="nick" required autofocus>
    </div>
    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
        <label for="pass">Contraseña:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-success" style="float: right;">Login</button>
</form> 

