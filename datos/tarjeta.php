<?php 
    // Función para buscar una tarjeta en base a su número y clave
    // con fines de autorización
    // $numeroTarjeta : Número de la tarjeta
    // $clave : Clave encriptada
    function getTarjeta($numeroTarjeta, $clave){
        $link = conectarse();
        // Realizamos la consulta SQL
        $instruccion = "SELECT * FROM tarjeta WHERE NUM_TARJETA = '$numeroTarjeta' AND CLAVE = '$clave'";    
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
?>