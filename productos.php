 <?php include './bases/header.html'; ?>

 <?php
    // Creación de variables inciales
    $monedas = ['S/', '$'];
    $tipocuentas = ['Ahorro Simple', 'Ahorro Sueldo'];
    $tipocreditos = ['Credito por Consumo', 'Credito Hipotecario'];
    $cuentas = array();
    $creditos = array();

    // Carga de las cuentas origen
    for ($i = 0; $i < 3; $i++) {
        $cuenta = [
            'Tipo' => strtoupper($tipocuentas[rand(0, 1)]),
            'Saldo' => mt_rand(0.00 * 100, 1000.00 * 100) / 100,
            'Codigo' => rand(100000000, 999999999),
            'Moneda' => $monedas[rand(0, 1)]
        ];
        array_push($cuentas, $cuenta);
    };

    // Carga de las cuentas destino
    for ($i = 0; $i < 3; $i++) {
        $credito = [
            'Tipo' => strtoupper($tipocreditos[rand(0, 1)]),
            'DeudaPendiente' => mt_rand(0.00 * 100, 1000.00 * 100) / 100,
            'Codigo' => rand(100000000, 999999999),
            'Moneda' => 'S/'
        ];
        array_push($creditos, $credito);
    };

    ?>

 <div class="w3-container" style="margin-top:60px" id="showcase">
     <h1 class="w3-text-red"><b>Productos</b></h1>

     <div class="w3-row-padding">
         <div class="w3-half w3-margin-bottom">
             <div class="w3-card-2">
                 <header class="w3-container w3-red">
                     <h4>Productos de ahorro</h4>
                 </header>
                 <div class="w3-container">
                     <ul class="w3-ul">
                         <?php
// Se muestran las cuentas origen en la pantalla
foreach ($cuentas as $cuenta) {
echo <<<EOT
<li><div class="w3-bar-item">
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
                 <header class="w3-container w3-red">
                     <h4>Productos de crédito</h4>
                 </header>
                 <div class="w3-container">
                     <ul class="w3-ul">
                         <?php
// Se muestran las cuentas destino en la pantalla                         
foreach ($creditos as $credito) {
echo <<<EOT
<li><div class="w3-bar-item">
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