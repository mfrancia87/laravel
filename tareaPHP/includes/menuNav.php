<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/tareaPHP/index.php">Inicio</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
                if(isset($_SESSION["nombre"])){
            ?>
            <li><a href="/tareaPHP/web/perfil.php">Ver mi perfil</a></li>
            <li><a href="/tareaPHP/web/logout.php">Cerrar sesión</a></li>
            
            <?php
                }
                else{
            ?>
                <li><a href="/tareaPHP/web/registro.php">Registro</a></li>
                <li><a href="/tareaPHP/web/login.php">Login</a></li>
            <?php
                }
            ?>       
        </ul>
    </div>
</nav>