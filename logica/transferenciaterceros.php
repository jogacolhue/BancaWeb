<?php include '../datos/conexion.php';?>
<?php include '../datos/cuenta.php';?>
<?php
    $cuentaOrigen= $_POST['cuentaOrigen'];
    $cuentaDestino=$_POST['cuentaDestino'];
    $moneda=$_POST['moneda'];
    $monto=$_POST['monto'];
    
    $validacion = validarTransferencia($cuentaOrigen, $cuentaDestino, $monto);
    
    realizarTransferencia($cuentaOrigen, $cuentaDestino, $monto);

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
    function validarTransferencia($cuentaOrigen, $cuentaDestino, $monto){
        if(strlen($cuentaDestino) != 9 ){
            $resultado['error'] = "La longitud de la cuenta destino debe ser de 9 caracteres.";
            // https://www.php.net/manual/en/function.json-encode.php
            echo json_encode($resultado);
            return false;
        } else{
            if(count(getCuenta($cuentaDestino)) == 0){
                $resultado['error'] = "No existe la cuenta de destino.";
                echo json_encode($resultado);
                return false;
            }    

            $cuentaOrigenDB = getCuenta($cuentaOrigen)[0];    
            $cuentaDestinoDB = getCuenta($cuentaDestino)[0];               
            if($monto > $cuentaOrigenDB["SALDO"]){
                $resultado['error'] = "El monto a transferir supera el de la cuenta origen.";
                echo json_encode($resultado);
                return false;
            }
            if($cuentaOrigenDB["COD_CLIENTE"] == $cuentaDestinoDB["COD_CLIENTE"]){
                $resultado['error'] = "No se puede usar una cuenta propia como destino.";
                echo json_encode($resultado);
                return false;
            }
            return true;
        }
    }

    function realizarTransferencia($cuentaOrigen, $cuentaDestino, $monto){
        $cuentaOrigenDB = getCuenta($cuentaOrigen)[0];
        $cuentaDestinoDB = getCuenta($cuentaDestino)[0];
        
        $montoDestino = $monto;

        if($cuentaOrigenDB["COD_MONEDA"] != $cuentaDestinoDB["COD_MONEDA"]){
            if($cuentaDestinoDB["COD_MONEDA"] == 2){
                $montoDestino = $monto / 3;
            }else{
                $montoDestino = $monto * 3;
            }
        }

        updateSaldo($cuentaOrigenDB["NUM_CUENTA"], $cuentaOrigenDB["SALDO"] - $monto);
        updateSaldo($cuentaDestinoDB["NUM_CUENTA"], $cuentaDestinoDB["SALDO"] + $montoDestino);

        setMovimiento($cuentaOrigenDB["NUM_CUENTA"], $monto, 2);
        setMovimiento($cuentaDestinoDB["NUM_CUENTA"], $montoDestino, 1);
    }

?>