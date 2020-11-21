<?php include './bases/header.html'; ?>

<?php
// Creación de variables inciales
$monedas = ['S/', '$'];
$tipoCuentas = ['Ahorro Simple', 'Ahorro Sueldo']; 
$cuentas = array(); 

// Carga de las cuentas del cliente
for ($i = 0; $i < 3; $i++) {
    $cuenta = [
        'Tipo' => strtoupper($tipoCuentas[rand(0, 1)]),
        'Saldo' => mt_rand(0.00 * 100, 1000.00 * 100) / 100,
        'Codigo' => rand(100000000, 999999999),
        'Moneda' => $monedas[rand(0, 1)]
    ];
    array_push($cuentas, $cuenta);
};

?>

<div class="w3-container" style="margin-top:60px" id="showcase">
     <h1 class="w3-text-dark-grey"><b>Transferencias a terceros</b></h1>

     <div class="w3-row-padding">
        <div class="w3-half w3-margin-bottom">
            <div class="w3-card-2">
                <header class="w3-container w3-dark-grey">
                    <h4>Productos origen</h4>
                </header>
                <div class="w3-container">
                    <ul class="w3-ul w3-hoverable">
                        <?php
// Se muestran las cuentas del cliente en la pantalla
foreach ($cuentas as $cuenta) {
echo <<<EOT
<li id="$cuenta[Codigo]1"><div class="w3-bar-item" onclick="agregarOrigen($cuenta[Codigo], '$cuenta[Moneda]')">
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
                    <h4>Producto destino</h4>
                </header>
                <div class="w3-container">
                    <label>Cuenta destino</label>
                    <input class="w3-input w3-border" type="text" onchange="agregarDestino(this.value)">
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="w3-row-padding">
        <div class="w3-half w3-margin-bottom">
            <div class="w3-card-2 w3-padding">
                <div class="w3-container" id="monto">
                    <label>Monto</label>
                    <input class="w3-input w3-border" type="number" step=".01" onchange="agregarMonto(this.value)">
                </div>
            </div>
        </div>

        <div class="w3-half w3-margin-bottom">
            <div class="w3-card-2">
                <div class="w3-container" id="previa">
                </div>
            </div>
            <button id="procesar" style="display: none;" class="w3-button w3-section w3-dark-grey w3-ripple" onclick="transferir()">Procesar</button>
        </div>
    </div> 

    <script src="./js/transferenciaterceros.js"></script>
</div>

<?php include './bases/footer.html'; ?>