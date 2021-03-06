<?php
    $cuentaOrigen= $_POST['cuentaOrigen'];
    $cuentaDestino=$_POST['cuentaDestino'];
    $moneda=$_POST['moneda'];
    $monto=$_POST['monto'];
    
    $validacion = validarTransferencia($cuentaOrigen, $cuentaDestino);
    
    $resultado = array(
        'cuentaOrigen' => $cuentaOrigen,
        'cuentaDestino' => $cuentaDestino,
        'moneda' => $moneda,
        'monto' => $monto,
        'error' => ''
    );

    // Resultado aprobado del proceso de transferencia
    if($validacion){
        echo json_encode($resultado);
    } 

    // Función para validar las transferencias realizadas
    // $cuentaOrigen : Cuenta origen de la operación
    // $cuentaDestino : Cuenta destino de la operación
    function validarTransferencia($cuentaOrigen, $cuentaDestino){
        if($cuentaOrigen ==  $cuentaDestino){
            $resultado['error'] = "No se pueden realizar transferencias entre la misma cuenta.";
            // https://www.php.net/manual/en/function.json-encode.php
            echo json_encode($resultado);
            return false;
        } else{
            return true;
        }
    }

?>