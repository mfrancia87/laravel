<?php require '../templates/header.php';?>

<form method="post" action="../php/login.php">
    <p>Mail:</p>
    <input type="email" name="email" required>
    <p>Password:</p>
    <input type="password" name="password" required>
    <input type="submit" value="Login">
</form> 

<?php require '../templates/footer.php';?>