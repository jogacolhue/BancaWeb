<?php include './bases/header.html'; ?>

<?php
$productoOrigen = $_POST['productoOrigen'] ?? "";
$productoDestino = $_POST['productoDestino'] ?? "";
$monto = $_POST['monto'] ?? 0;
$moneda = $_POST['moneda'] ?? "";
?>

<div class="w3-container" style="margin-top:60px" id="showcase">
     <h1 class="w3-text-dark-grey"><b>Resultado de la operación</b></h1>

     <div class="w3-row-padding">
          <div class="w3-quarter w3-hide-small" style="color: white;">.</div>
          <div class="w3-half w3-margin-bottom">
               <div class="w3-card-2">
                    <header class="w3-container w3-dark-grey">
                         <h4>Detalles</h4>
                    </header>

                    <div class="w3-container">
                         <h5><b>Origen</b></h5>
                         <p>Número de producto: <?php echo $productoOrigen ?> </p> 
                         <hr>
                         <h5><b>Destino</b></h5>
                         <p>Número de producto: <?php echo $productoDestino ?></p>
                         <hr>
                         <h5><b>Monto de la operación</b></h5>
                         <p><?php echo $moneda . " " . $monto ?> </p>
                    </div> 

               </div>
          </div>
     </div>
</div>

<?php include './bases/footer.html'; ?>