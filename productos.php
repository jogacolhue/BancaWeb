 <?php include './logica/seguridad.php';?>
 <?php include './datos/conexion.php';?>
 <?php include './datos/cuenta.php';?>
 <?php include './datos/credito.php';?>
 <?php include './bases/header.html'; ?>
 <?php
    // Creación de variables inciales 
    $cuentas = array();
    $creditos = array();

    // Carga de las cuentas del cliente 
    foreach (getCuentas($_SESSION["codigoCliente"]) as $cuentaDB){
        $cuenta = [
            'Tipo' => strtoupper($cuentaDB["NOM_TIPO_CUENTA"]), 
            'Saldo' => $cuentaDB["SALDO"],
            'Codigo' => $cuentaDB["NUM_CUENTA"],
            'Moneda' => $cuentaDB["SIMBOLO"]
        ];
        array_push($cuentas, $cuenta);
    }

    // Carga de los créditos del cliente 
    foreach (getCreditos($_SESSION["codigoCliente"]) as $creditoDB){
        $credito = [
            'Tipo' => strtoupper($creditoDB["NOM_TIPO_CREDITO"]), 
            'DeudaPendiente' => $creditoDB["DEUDA"],
            'Codigo' => $creditoDB["NUM_CREDITO"],
            'Moneda' => $creditoDB["SIMBOLO"]
        ];
        array_push($creditos, $credito);
    }

    ?>

 <div class="w3-container" style="margin-top:60px" id="showcase">
     <h1 class="w3-text-dark-grey"><b>Productos</b></h1>

     <div class="w3-row-padding">
         <div class="w3-half w3-margin-bottom">
             <div class="w3-card-2">
                 <header class="w3-container w3-dark-grey">
                     <h4>Productos de ahorro</h4>
                 </header>
                 <div class="w3-container">
                     <ul class="w3-ul w3-hoverable">
                         <?php
// Se muestran las cuentas origen en la pantalla
foreach ($cuentas as $cuenta) {
echo <<<EOT
<li><div class="w3-bar-item" onclick="location.href='./cuenta.php?cuenta=$cuenta[Codigo]'">
<span class="w3-large">$cuenta[Tipo]</span><br>
<span>Código $cuenta[Codigo]</span><br>
<span>Saldo $cuenta[Moneda] $cuenta[Saldo]</span>
</div></li>
EOT;
}
                            ?>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="w3-half w3-margin-bottom">
             <div class="w3-card-2">
                 <header class="w3-container w3-dark-grey">
                     <h4>Productos de crédito</h4>
                 </header>
                 <div class="w3-container">
                     <ul class="w3-ul w3-hoverable">
                         <?php
// Se muestran los créditos en la pantalla                         
foreach ($creditos as $credito) {
echo <<<EOT
<li><div class="w3-bar-item" onclick="location.href='./credito.php?credito=$credito[Codigo]'">
<span class="w3-large">$credito[Tipo]</span><br>
<span>Código $credito[Codigo]</span><br>
<span>Deuda pendiente $credito[Moneda] $credito[DeudaPendiente]</span>
</div></li>
EOT;
                            }
                            ?>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <?php include './bases/footer.html'; ?>