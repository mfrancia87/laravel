<?php 
 session_start();
 
 //si no está logueado o si el usuario no es admin
if(!isset($_SESSION["idUsuario"]) || $_SESSION["idUsuario"]!=1){
    header("Location: ../index.php");
}
 
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idCliente = filter_input(INPUT_GET, "id");

$conexion = conectarBD();
$datosCliente = getUsuarioById($conexion, $idCliente);
$recursosCliente = listarRecursosObtenidos($conexion, $idCliente);
        //listarRecursos($conexion, $idCliente);

if($datosCliente != NULL){
?>

<div class="panel panel-info">
    <div class="panel-heading">Proveedor: <strong><?php echo "$datosCliente[1]" ?> </strong></div>
  <div class="panel-body">
    
  
  <div class="col-lg-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <img style="display: block; margin: auto" src="<?php echo $datosCliente[7] ?>" height="200px" class="img-rounded" align="middle">
        </div>
  </div>
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <div class="form-group">
        <label for="nick">Nick:</label>
        <input type="text" class="form-control" name="nick" value="<?php echo $datosCliente[1]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" value="<?php echo $datosCliente[2]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $datosCliente[4]; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" name="apellido" value="<?php echo $datosCliente[5]; ?>" readonly>
    </div> 
      
  </div>
    
      
  </div>
</div>


    <?php
        if($recursosCliente != NULL){
    ?>
<div class="panel panel-info">
    <div class="panel-heading">Recursos adquiridos por <strong><?php echo "$datosCliente[1]" ?> </strong></div>
    <div class="panel-body">
<div class="table-responsive">
    <table id="recursos" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo de recurso</th>
            <th>Para plan:</th>
            <th>Ver más</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($recursosCliente as $recurso) {
          ?>
          <tr class="clickable-row">
            <td><?php echo "$recurso[2]" ?></td>
            <td><?php echo "$recurso[3]" ?></td>
            <td><?php echo "$recurso[5]" ?></td>
            <td><?php echo "$recurso[6]" ?></td>
            <td><a href="verRecurso.php?id=<?php echo $recurso[0] ?>&idProveedor=<?php echo $recurso[1]?>" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
          </tr>
          <?php
            }
          
          ?>
          
        </tbody>
    </table>
</div>
</div>
</div>
    <?php
        }
        else{
            ?>
    <div class="panel panel-danger">
        <div class="panel-heading">Recursos adquiridos por <strong><?php echo "$datosCliente[1]" ?> </strong></div>
        <div class="panel-body">
      <?php
            echo "<h3>"."$datosCliente[1]"." aún no ha comprado ningún recurso</h3>";
        }
    ?>
        </div>
    </div>

<?php
}
else{
?>
      <div class="panel panel-danger">
        <div class="panel-heading">Error en cliente:</div>
        <div class="panel-body">
            <h2>El cliente seleccionado no existe. Inténtelo nuevamente</h2>
            <h3>Redirigiendo a lista de clientes...</h3>
        </div>
      </div>
<script>
$(function(){
    var delay = 4000; //milisegundos
    var pagina = "listarClientes.php";
    setTimeout(function(){ 
        window.location = pagina; 
    }, delay);
});
</script>
<?php
}
desconectarBD($conexion);

require '../includes/footer.php';

