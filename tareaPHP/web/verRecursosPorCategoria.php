<?php 
 session_start();
 require '../includes/header.php';

 require '../includes/menuNav.php';
 require '../includes/operacionesBD.php';
 
$idCategoria = filter_input(INPUT_GET, "id");

$conexion = conectarBD();

$categoria = getCategoriaById($conexion, $idCategoria);

$listaRecursos = getRecursosByCategoriaId($conexion, $idCategoria);

if($listaRecursos != NULL){
?>

<div class="panel panel-info">
        <div class="panel-heading">Recursos de la categoría <strong><?php echo "$categoria[0]" ?> </strong></div>
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
            foreach ($listaRecursos as $recurso) {
          ?>
            <tr class="clickable-row">
            <td><?php echo "$recurso[2]" ?></td>
            <td><?php echo "$recurso[3]" ?></td>
            <td><?php echo "$recurso[5]" ?></td>
            <td><?php echo "$recurso[6]" ?></td>
            <td><a href="verRecurso.php?id=<?php echo $recurso[0] ?>" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></a></td>
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
        <div class="panel-heading">Recursos de la categoría <strong><?php echo "$categoria[0]" ?> </strong></div>
        <div class="panel-body">
        <?php
            echo "<h3>La categoría $categoria[0] no tiene ningún recurso aún</h3>";
        ?>
        </div>
    </div>
<?php
}

desconectarBD($conexion);

require '../includes/footer.php';

