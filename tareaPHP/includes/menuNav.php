<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#opciones">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="/tareaPHP/index.php">Inicio</a>
        </div>
        <div class="collapse navbar-collapse" id="opciones">
        <ul class="nav navbar-nav">
            <?php
                if(!isset($_SESSION["nombre"])){    //si es visitante
            ?>
                <li><a href="/tareaPHP/web/registro.php">Registro</a></li>
                <li><a href="/tareaPHP/web/login.php">Login</a></li>
            <?php
                }
                if(isset($_SESSION["nombre"]) && $_SESSION["esProveedor"]==true){    //si es proveedor
            ?>
                <li><a href="/tareaPHP/web/misRecursosPublicados.php">Ver mis recursos publicados</a></li>
            <?php
            }
                if(isset($_SESSION["nombre"]) && $_SESSION["esProveedor"]==false){    //si es cliente
            ?>
                <li><a href="/tareaPHP/web/misRecursosConsumidos.php">Ver mis recursos obtenidos</a></li>
            <?php
                }
                if(isset($_SESSION["nombre"]) && $_SESSION["idUsuario"]!=1){    //si es cliente o proveedor
            ?>
                <li><a href="/tareaPHP/web/perfil.php">Ver mi perfil</a></li>
                <li><a href="/tareaPHP/web/verSuscripcion.php">Ver mi suscripción</a></li>
                <li><a href="/tareaPHP/web/logout.php">Cerrar sesión</a></li>
            
            <?php
                }
                if(isset($_SESSION["nombre"]) && $_SESSION["idUsuario"]==1){    //si es  administrador
            ?>
                <li><a href="/tareaPHP/web/perfil.php">Ver mi perfil</a></li>
                <li><a href="/tareaPHP/web/actualizarPreciosSuscripciones.php">Precios suscripciones</a></li>
                <li><a href="/tareaPHP/web/gestionarCategorias.php">Gestionar categorias</a></li>
                <li><a href="/tareaPHP/web/listarClientes.php">Listar clientes</a></li>
                <li><a href="/tareaPHP/web/listarProveedores.php">Listar proveedores</a></li>
                <li><a href="/tareaPHP/web/logout.php">Cerrar sesión</a></li>
            <?php
                }
            ?>
        </ul>
        </div>
    </div>
</nav>