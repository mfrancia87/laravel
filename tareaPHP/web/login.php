<?php require '../includes/header.php';

 require '../includes/menuNav.php';
?>

<form method="post" action="../phpScripts/login.php">
    <p>Nick:</p>
    <input type="text" name="nick" required autofocus>
    <p>Password:</p>
    <input type="password" name="password" required>
    <input type="submit" value="Login">
</form> 

<?php
 require '../includes/footer.php';
 ?>