<?php include './bases/header.html'; ?>

<?php
// Cuenta a detallar
$cuenta = $_GET['cuenta'] ?? 0;

$simbolo = ['+', '-'];
$movimientos = array();

// https://www.php.net/manual/en/function.getdate.php
$fecha = getdate();

// Carga de los movimientos
for ($i = 0; $i < 20; $i++) {
    $movimiento = [
        'FechaHora' => $fecha["mday"] . "/" . $fecha["mon"] . "/" . $fecha["year"] . " " . $fecha["hours"] . ":" . $fecha["minutes"] . ":" . $fecha["seconds"],
        'Tipo' => "Transferencia",
        'Simbolo' => $simbolo[rand(0, 1)],
        'Monto' => rand(0.00 * 100, 1000.00 * 100) / 100,
        'Moneda' => "S/",
    ];
    array_push($movimientos, $movimiento);
};

?>

<div class="w3-container" style="margin-top:60px" id="showcase">
    <h1 class="w3-text-dark-grey"><b>Movimientos de la cuenta <?php echo $cuenta ?></b></h1>

    <div class="w3-row-padding">
        <div class="w3-margin-bottom"> 
            <table class="w3-table-all w3-hoverable w3-card w3-hide-small">
                <thead>
                    <tr class="w3-dark-grey">
                        <th>FECHA Y HORA</th>
                        <th>TIPO DE MOVIMIENTO</th>
                        <th>MONTO</th>
                    </tr>
                </thead>
                <tbody>
                <?php
// Se muestran las cuentas origen en la pantalla
foreach ($movimientos as $movimiento) {
echo <<<EOT
<tr>
<td><span class="fecha">$movimiento[FechaHora]</span></td>
<td><span class="descripcion">$movimiento[Tipo]</span></td>
<td>$movimiento[Simbolo] $movimiento[Moneda] $movimiento[Monto]</td>
</tr>
EOT;
}
                        ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './bases/footer.html'; ?>