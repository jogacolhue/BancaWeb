<?php
    $cuentaOrigen= $_POST['cuentaOrigen'];
    $cuentaDestino=$_POST['cuentaDestino'];
    $moneda=$_POST['moneda'];
    $monto=$_POST['monto'];
    
    $validacion = validarTransferencia($cuentaOrigen, $cuentaDestino);
    
    if($validacion){
        echo ("Transferencia simulada desde la cuenta " . $cuentaOrigen . " a la cuenta " . $cuentaDestino .
    " por el monto de " . $moneda . " " . $monto);
    } 

    function validarTransferencia($cuentaOrigen, $cuentaDestino){
        if($cuentaOrigen ==  $cuentaDestino){
            echo ("No se pueden realizar transferencias entre la misma cuenta.");
            return false;
        } else{
            return true;
        }
    }
?>