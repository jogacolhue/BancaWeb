<?php include '../datos/conexion.php';?>
<?php include '../datos/cuenta.php';?>
<?php include '../datos/credito.php';?>
<?php
    $cuenta= $_POST['cuenta'];
    $credito=$_POST['credito'];
    $moneda=$_POST['moneda'];
    $monto=$_POST['monto'];
    
    $validacion = validarTransferencia($cuenta, $credito, $monto);
    
    realizarPago($cuenta, $credito, $monto);

    $resultado = array(
        'cuenta' => $cuenta,
        'credito' => $credito,
        'moneda' => $moneda,
        'monto' => $monto,
        'error' => ''
    );

    // Resultado aprobado del proceso de transferencia
    if($validacion){
        echo json_encode($resultado);
    } 

    // Función para validar las transferencias realizadas
    // $cuenta : Cuenta de la operación
    // $credito : Crédito de la operación
    // $monto : Monto a pagar del crédito
    function validarTransferencia($cuenta, $credito, $monto){
        $cuentaDB = getCuenta($cuenta)[0];
        $creditoDB = getCredito($credito)[0];

        if($monto > $creditoDB["DEUDA"]){
            $resultado['error'] = "No se puede superar el monto de la deuda pendiente.";
            echo json_encode($resultado);
            return false;
        }

        $montoOrigen = $monto;
        
        if($cuentaDB["COD_MONEDA"] == 2){
            $montoOrigen = $monto / 3;
        }

        if($montoOrigen > $cuentaDB["SALDO"]){
            $resultado['error'] = "El monto a pagar supera el saldo de la cuenta.";
            echo json_encode($resultado);
            return false;
        }

        return true;
    } 

    // Función para hacer el procesamiento del pago de crédito
    // $cuenta : Cuenta a debitar 
    // $credito : Crédito a pagar
    // $monto : Monto de pago del crédito
    function realizarPago($cuenta, $credito, $monto){
        $cuentaDB = getCuenta($cuenta)[0];
        $creditoDB = getCredito($credito)[0];

        $montoOrigen = $monto;
        
        if($cuentaDB["COD_MONEDA"] == 2){
            $montoOrigen = $monto / 3;
        } 

        setMovimiento($cuentaDB["NUM_CUENTA"], $montoOrigen, 3);
        setPago($creditoDB["NUM_CREDITO"], $monto);

        updateSaldo($cuentaDB["NUM_CUENTA"], $cuentaDB["SALDO"] - $montoOrigen);

        if($creditoDB["DEUDA"] - $monto > 0){
            updateDeuda($creditoDB["NUM_CREDITO"], $creditoDB["DEUDA"] - $monto);
        }
        else{
            deleteCredito($creditoDB["NUM_CREDITO"]);
        }
        
    }

?>