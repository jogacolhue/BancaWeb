<?php     
    function getCuentas($codCliente){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "SELECT C.NUM_CUENTA, C.SALDO, TC.NOM_TIPO_CUENTA, M.SIMBOLO FROM cuenta C
        INNER JOIN tipo_cuenta TC ON TC.COD_TIPO_CUENTA = C.COD_TIPO_CUENTA
        INNER JOIN moneda M ON M.COD_MONEDA = C.COD_MONEDA
        WHERE COD_CLIENTE = '$codCliente' AND C.ESTADO = 'A'";    
        $result = mysqli_query($link, $instruccion); 
        $items = array();
        while($row = mysqli_fetch_assoc($result)) 
        {
        $items[] = $row;  
        }
        // Cerramos la conexión
        mysqli_close($link); 
        return $items;
    } 

    function getMovimientos($codCuenta){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "SELECT TMC.DES_TIPO_MOVIMIENTO_CUENTA, TMC.SIMBOLO, MC.FEC_SISTEMA, MC.MONTO, M.SIMBOLO AS SIMBOLO_MONEDA FROM movimiento_cuenta MC
        INNER JOIN tipo_movimiento_cuenta TMC ON TMC.COD_TIPO_MOVIMIENTO_CUENTA = MC.COD_TIPO_MOVIMIENTO_CUENTA
        INNER JOIN cuenta C ON C.NUM_CUENTA = MC.NUM_CUENTA
        INNER JOIN moneda M ON M.COD_MONEDA = C.COD_MONEDA
        WHERE MC.NUM_CUENTA = '$codCuenta'
        ORDER BY MC.FEC_SISTEMA DESC";
        $result = mysqli_query($link, $instruccion); 
        $items = array();
        while($row = mysqli_fetch_assoc($result)) 
        {
        $items[] = $row;  
        }
        // Cerramos la conexión
        mysqli_close($link); 
        return $items;
    }

    function getCuenta($codCuenta){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "SELECT * FROM cuenta C 
        WHERE C.NUM_CUENTA = '$codCuenta' AND C.ESTADO = 'A'";    
        $result = mysqli_query($link, $instruccion); 
        $items = array();
        while($row = mysqli_fetch_assoc($result)) 
        {
        $items[] = $row;  
        }
        // Cerramos la conexión
        mysqli_close($link); 
        return $items;
    }

    function updateSaldo($codCuenta, $saldo){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "UPDATE cuenta C SET C.SALDO = '$saldo' WHERE C.NUM_CUENTA = '$codCuenta'";     
        $result=mysqli_query($link, $instruccion); 
        // Cerramos la conexión
        mysqli_close($link); 
        return $result;
    }

    function setMovimiento($codCuenta, $monto, $tipoMovimiento){
        $link = conectarse(); 
        $fecha = date("Y-m-d H:i:s");
        // Realizamos la instrucción SQL
        $instruccion = "INSERT INTO movimiento_cuenta (COD_TIPO_MOVIMIENTO_CUENTA, NUM_CUENTA, FEC_SISTEMA, MONTO) 
        VALUES ('$tipoMovimiento', '$codCuenta', '$fecha', '$monto')";     
        $result=mysqli_query($link, $instruccion); 
        // Cerramos la conexión
        mysqli_close($link); 
        return $result;
    }
?>