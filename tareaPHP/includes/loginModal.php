<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true" style="color: white; opacity: 1;">&times;</span><span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title" id="modal-login-label">Login</h3>
                <p>Ingrese su nombre de usuario y contraseña:</p>
            </div>
            <div class="modal-body">
                <form method="post" action="/tareaPHP/phpScripts/login.php">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="nick">Nick:</label>
                        <input type="text" class="form-control" name="nick" required autofocus>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="pass">Contraseña:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" style="float: right;">Login</button>
                </form>
            </div>
            
        </div>
    </div>
</div> <!-- modal -->