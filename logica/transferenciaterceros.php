<?php
    $cuentaOrigen= $_POST['cuentaOrigen'];
    $cuentaDestino=$_POST['cuentaDestino'];
    $moneda=$_POST['moneda'];
    $monto=$_POST['monto'];
    
    $validacion = validarTransferencia($cuentaDestino);
    
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
    // $cuentaDestino : Cuenta destino de la operación
    function validarTransferencia($cuentaDestino){
        if(strlen($cuentaDestino) != 9 ){
            $resultado['error'] = "La longitud de la cuenta destino debe ser de 9 caracteres.";
            // https://www.php.net/manual/en/function.json-encode.php
            echo json_encode($resultado);
            return false;
        } else{
            return true;
        }
    }

?>