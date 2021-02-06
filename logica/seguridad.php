<?php
    $seg = session_start();
	if($_SESSION["autenticado"]!="SI"){
		header("Location: ./index.php" );
		exit();
		}else {
		//sino, calculamos el tiempo transcurrido
		$fechaGuardada = $_SESSION["ultimoAcceso"];
        $ahora = date("Y-m-d H:i:s");
        //strtotime nos da el UNIX timestamp, para poder obtener la diferencia en segundos
		$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
		//comparamos el tiempo transcurrido
		if($tiempo_transcurrido >= 120) {
		//si pasaron 2 minutos o más
		session_destroy(); // destruyo la sesión
		header("Location: ./index.php"); //envío al usuario a la pag. de autenticación
		//sino, actualizo la fecha de la sesión
		}else {
		$_SESSION["ultimoAcceso"] = $ahora;
		}
		}
?>