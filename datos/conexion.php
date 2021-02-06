<?php
	// Función para la conexión con el servidor de base de datos
    function conectarse(){
    	//Conectar con el servidor de base de datos
    	if (!($link = mysqli_connect("localhost", "bancaweb", "123", "banca_web"))){
    		echo "Error conectando a la Base de Datos.";
			exit();
    	} 
		//Establece el formato del texto a usar (https://www.php.net/manual/en/mysqli.set-charset.php)
		mysqli_set_charset($link, "UTF8");
		return $link;
    }
?>