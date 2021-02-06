<?php include './logica/seguridad.php';?>
<?php include './datos/conexion.php';?>
<?php include './datos/credito.php';?>
<?php include './bases/header.html'; ?>

<?php
// credito a detallar
$credito = $_GET['credito'] ?? 0;

$movimientos = array();

// Carga de los movimientos ;
foreach (getPagos($credito) as $pagoDB){
    $movimiento = [
        'FechaHora' => $pagoDB["FEC_SISTEMA"],
        'Tipo' => $pagoDB["DESCRIPCION"], 
        'Monto' => $pagoDB["MONTO"],
        'Moneda' => $pagoDB["SIMBOLO"]
    ];
    array_push($movimientos, $movimiento);
}

?>

<div class="w3-container" style="margin-top:60px" id="showcase">
    <h1 class="w3-text-dark-grey"><b>Pagos del crédito <?php echo $credito ?></b></h1>

    <div class="w3-row-padding">
        <div class="w3-margin-bottom"> 
            <table class="w3-table-all w3-hoverable w3-card w3-hide-small">
                <thead>
                    <tr class="w3-dark-grey">
                        <th>FECHA Y HORA</th>
                        <th>TIPO DE OPERACION</th>
                        <th>MONTO</th>
                    </tr>
                </thead>
                <tbody>
                <?php
// Se muestran las creditos origen en la pantalla
if(count($movimientos) == 0){
echo <<<EOT
<tr>
<td colspan="3">SIN MOVIMIENTOS</td>
</tr>
EOT;
}
foreach ($movimientos as $movimiento) {
echo <<<EOT
<tr>
<td><span class="fecha">$movimiento[FechaHora]</span></td>
<td><span class="descripcion">$movimiento[Tipo]</span></td>
<td>$movimiento[Moneda] $movimiento[Monto]</td>
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