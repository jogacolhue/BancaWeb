<?php 
include '../datos/conexion.php';
include '../datos/tarjeta.php';
// Se obtiene los datos del envió del formulario
if ( isset( $_POST['submit'] ) ){  
    $tarjeta = $_REQUEST['tarjeta'];
    $clave = $_REQUEST['clave'];

    $confirmado = ValidarCredenciales($tarjeta, $clave);
    
    if ($confirmado){
        header("location: ../productos.php");
    }else{ 
        header("location: ../index.php?errorLogin=1");
    }

}

// Función para la validación de credencias de la tarjeta y clave del cliente
// $tarjeta : Número de tarjeta del cliente
// $clave : Clave de la tarjeta
function ValidarCredenciales ($tarjeta, $clave)
{ 
    $tarjetas = getTarjeta($tarjeta, md5($clave));     
    if(count($tarjetas) == 1 ){
        session_start();
        $_SESSION['codigoCliente'] = $tarjetas[0]['COD_CLIENTE'];
        $_SESSION["autenticado"] ="SI";
        $_SESSION["ultimoAcceso"] = date("Y-m-d H:i:s"); 
        return true;
    }else{
        return false;
    }
}
 
?>