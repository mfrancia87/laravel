<nav class="navbar navbar-inverse navbar-fixed-top" style="font-family: rockwell;">
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
                <li><a href="/tareaPHP/web/listarRecursos.php">Ver recursos</a></li>
                </ul>
            
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Buscar recursos">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/tareaPHP/web/registro.php">Registro</a></li>
                    <li><a href="/tareaPHP/web/login.php">Login</a></li>
                </ul>
            <?php
                }
                if(isset($_SESSION["nombre"]) && $_SESSION["esProveedor"]==true){    //si es proveedor
            ?>
                <li><a href="/tareaPHP/web/listarRecursos.php">Ver recursos</a></li>
                <li><a href="/tareaPHP/web/misRecursosPublicados.php">Ver mis recursos publicados</a></li>
                </ul>
                
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Buscar recursos">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                
                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/tareaPHP/web/perfil.php">Ver mi perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/tareaPHP/web/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                </ul>
                
                
                
            <?php
            }
                if(isset($_SESSION["nombre"]) && $_SESSION["esProveedor"]==false && ($_SESSION["idUsuario"]!=1)){    //si es cliente
            ?>
                <li><a href="/tareaPHP/web/listarRecursos.php">Ver recursos</a></li>
                <li><a href="/tareaPHP/web/misRecursosObtenidos.php">Ver mis recursos obtenidos</a></li>
                <li><a href="/tareaPHP/web/verSuscripcion.php">Ver mi suscripción</a></li>
                </ul>
                
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Buscar recursos">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                
                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/tareaPHP/web/perfil.php">Ver mi perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/tareaPHP/web/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                </ul>
            
            <?php
                }
                if(isset($_SESSION["nombre"]) && $_SESSION["idUsuario"]==1){    //si es  administrador
            ?>
                <li><a href="/tareaPHP/web/listarRecursos.php">Ver recursos</a></li>
                <li><a href="/tareaPHP/web/actualizarPreciosSuscripciones.php">Precios suscripciones</a></li>
                <li><a href="/tareaPHP/web/gestionarCategorias.php">Gestionar categorias</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listar<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/tareaPHP/web/listarClientes.php">Listar clientes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/tareaPHP/web/listarProveedores.php">Listar proveedores</a></li>
                        </ul>
                        
                    </li>
                </ul>
                
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Buscar recursos">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                
                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/tareaPHP/web/perfil.php">Ver mi perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/tareaPHP/web/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                </ul>
            <?php
                }
            ?>
        
        </div>
    </div>
</nav>

<style>

.navbar-inverse .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
        font-family: rockwell;
        color: #a4fae7;
}
</style>