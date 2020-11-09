<?php 

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

function ValidarCredenciales ($tarjeta, $clave)
{
    if($tarjeta == "4772000012345678" && $clave == 1234){
        return true;
    }else{
        return false;
    }
}
 
?>