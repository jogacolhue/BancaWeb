<?php 
    // Función para obtener la lista de créditos
    // $codCliente : Código del cliente propietario de los créditos
    function getCreditos($codCliente){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "SELECT C.NUM_CREDITO, C.DEUDA, TC.NOM_TIPO_CREDITO, M.SIMBOLO FROM CREDITO C
        INNER JOIN TIPO_CREDITO TC ON TC.COD_TIPO_CREDITO = C.COD_TIPO_CREDITO
        INNER JOIN MONEDA M ON M.COD_MONEDA = C.COD_MONEDA
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

    // Función para obtener los pagos de los créditos
    // $codCredito : Número del crédito a consultar
    function getPagos($codCredito){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "SELECT 'Pago de crédito' AS DESCRIPCION, PC.FEC_SISTEMA, PC.MONTO, M.SIMBOLO  FROM PAGO_CREDITO PC
        INNER JOIN CREDITO C ON C.NUM_CREDITO = PC.NUM_CREDITO
        INNER JOIN MONEDA M ON M.COD_MONEDA = C.COD_MONEDA
        WHERE PC.NUM_CREDITO = '$codCredito'
        ORDER BY PC.FEC_SISTEMA DESC";
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

    // Función para obtener los datos de un crédito
    // $codCredito : Número del crédito a consultar
    function getCredito($codCredito){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "SELECT * FROM CREDITO C 
        WHERE C.NUM_CREDITO = '$codCredito' AND C.ESTADO = 'A'";    
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

    // Función para actualizar la deuda de un crédito
    // $codCredito : Número del crédito a actualizar
    // $deuda : Nueva deuda
    function updateDeuda($codCredito, $deuda){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "UPDATE CREDITO C SET C.DEUDA = '$deuda' WHERE C.NUM_CREDITO = '$codCredito'";     
        $result=mysqli_query($link, $instruccion); 
        // Cerramos la conexión
        mysqli_close($link); 
        return $result;
    }

    // Función para registrar el pago realizado
    // $codCredito : Número del crédito pagado
    // $monto : Monto pagado
    function setPago($codCredito, $monto){
        $link = conectarse(); 
        $fecha = date("Y-m-d H:i:s");
        // Realizamos la instrucción SQL
        $instruccion = "INSERT INTO PAGO_CREDITO (NUM_CREDITO, FEC_SISTEMA, MONTO) 
        VALUES ('$codCredito', '$fecha', '$monto')";     
        $result=mysqli_query($link, $instruccion); 
        // Cerramos la conexión
        mysqli_close($link); 
        return $result;
    }

    // Función para eliminar un crédito pagado completamente
    // (En un ambiente de producción sólo se actualizaría el estado, pero 
    // lo creo para tener un ejemplo de DELETE)
    // $codCredito : Número del crédito pagado
    function deleteCredito($codCredito){
        $link = conectarse();
        // Realizamos la instrucción SQL
        $instruccion = "DELETE FROM CREDITO WHERE NUM_CREDITO = '$codCredito'";     
        $result=mysqli_query($link, $instruccion); 
        // Cerramos la conexión
        mysqli_close($link); 
        return $result;
    }
?>