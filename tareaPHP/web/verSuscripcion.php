<?php 

session_start();
require '../includes/header.php';
require '../includes/menuNav.php';
         
 if(isset($_SESSION["plan"])){
    $planUsuario = $_SESSION["plan"];
}
require '../includes/operacionesBD.php';

$conexion = conectarBD();
$preciosPlanes = preciosPlanes($conexion);

$free = "<span><strong>FREE</strong> || Completamente gratuito!!</span>";
$silver = "<span><strong>SILVER</strong> || $preciosPlanes[1] USD por mes</span>";
$gold = "<span><strong>GOLD</strong> || $preciosPlanes[2] USD por mes</span>";

?>


<div class="panel panel-info">
  <div class="panel-heading">Cambiar mi plan:</div>
  <h3>Usted cuenta con el plan <strong><?php echo "$planUsuario"; ?></strong></h3>
  <div class="panel-body">
    
  <form method="post" action="../phpScripts/cambiarSuscripcion.php" enctype="multipart/form-data">
    <?php if($planUsuario == 'free'){
    ?>
        <div class="form-group">
            <label for="planNuevo">Elija un nuevo plan:</label>
            <select class="form-control" name="planNuevo" id="planNuevo">
                <option value=""></option>
                <option value="silver"><?php echo "$silver"; ?></option>
                <option value="gold"><?php echo "$gold"; ?></option>
            </select>
        </div>
    <?php
    }
    
    if($planUsuario == 'silver'){
    ?>
        <div class="form-group">
            <label for="planNuevo">Elija un nuevo plan:</label>
            <select class="form-control" name="planNuevo" id="planNuevo">
                <option value=""></option>
                <option value="free"><?php echo "$free"; ?></option>
                <option value="gold"><?php echo "$gold"; ?></option>
            </select>
        </div>
    <?php
    }
    
    if($planUsuario == 'gold'){
    ?>
        <div class="form-group">
            <label for="planNuevo">Elija un nuevo plan:</label>
            <select class="form-control" name="planNuevo" id="planNuevo">
                <option value=""></option>
                <option value="free"><?php echo "$free"; ?></option>
                <option value="silver"><?php echo "$silver"; ?></option>
            </select>
        </div>
    <?php
    }
    ?>
      <button id="cambiarPlan" type="submit" class="btn btn-success">Cambiar de plan</button>
    
    </form>
     
  </div>
</div>

<script>
    $(function(){
        
        $('#planNuevo').on('change', function(){
           var plan = $(this).find(":selected").val();
           console.log(plan);
           
            var mensajePago = "Has cambiado de plan";

            var precios = [<?php echo '"'.implode('","', $preciosPlanes).'"' ?>];
            if(plan == "free"){
                mensajePago = "Ha accedido al plan Free. Usted perderá el plan que tenía, no existiendo reembolso del mismo";
            }
            if(plan == "silver"){
                mensajePago = "Ha accedido al plan Silver. Se le remitirá a su tarjeta de crédito un total de " + precios[1] + " USD por mes";
            }
            if(plan == "gold"){
                mensajePago = "Ha accedido al plan Gold. Se le remitirá a su tarjeta de crédito un total de " + precios[2] + " USD por mes";
            }

            $('#cambiarPlan').on('click', function(e){
                e.preventDefault;
                alert(mensajePago);
            });
        });
    });
</script>

<?php
 require '../includes/footer.php';
 ?>