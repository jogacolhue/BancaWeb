<?php 
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
    if($tarjeta == "4772000012345678" && $clave == 1234){
        return true;
    }else{
        return false;
    }
}
 
?>