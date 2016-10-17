<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$conexion = conectarBD();
$listaRecursos = listarTodosRecursos($conexion);



if($listaRecursos != NULL){
    foreach ($listaRecursos as $recurso) {
?>
<div class="container">
<div class="row">
    <div class="col-lg-2 col-sm-2 col-xs-6">
        <div class="panel panel-info">
            <div class="panel-heading">Recurso: <strong><?php echo "$recurso[2]" ?> </strong></div>
            <div class="panel-body">
        
                <div class="form-group" style="width: 80%; margin: auto;">
                  <img style="display: block; margin: auto" src="<?php echo $recurso[4] ?>" height="100px" class="img-responsive img-rounded" align="middle">
              </div>
        </div>
          <div class="form-group">
              <label for="tipoRecurso">Tipo recurso:</label>
              <input type="text" class="form-control" name="tipoRecurso" value="<?php echo $recurso[5]; ?>" readonly>
          </div>
          <div class="form-group">
              <label for="tipoPlan">Tipo plan:</label>
              <input type="text" class="form-control" name="tipoPlan" value="<?php echo $recurso[6]; ?>" readonly>
          </div>
       
        <div class="panel-footer">
            <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="verRecurso.php?id=<?php echo $recurso[0]; ?>">Ver recurso</a></button>
        </div>
    </div>
    </div>
</div>
</div>
<?php
    }
}
else{
    echo "<h3>No hay recursos agregados aún</h3>";
    header( "refresh:5;url=../index.php" );
}

desconectarBD($conexion);