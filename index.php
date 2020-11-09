<?php 
    // Variables para la muestra del mensaje de validación rechazada en el inicio de sesión
    $errorLogin = $_GET['errorLogin'] ?? 0; 
    $mensajeError = "Tarjeta y/o contraseña no válida. Tarjeta: 4772000012345678, Clave: 1234";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
</head>


<body>
    <div class="w3-row-padding">

        <div class="w3-third w3-margin-bottom">

        </div>

        <div class="w3-third w3-margin-bottom">

            <div class="w3-card-2" style="margin-top: 100px;">
                <header class="w3-container">
                    <h1>Banca Web</h1>
                </header>
                <form class="w3-container" method="POST" action="logica/login.php">

                    <p>
                        <input class="w3-input" type="text" style="width:90%" name="tarjeta" maxlength="16" required>
                        <label>Tarjeta</label></p>
                    <p>
                        <input class="w3-input" type="password" style="width:90%" name="clave" maxlength="4" required>
                        <label>Clave</label></p>
                    <p>
                        <input type="submit" class="w3-button w3-section w3-red w3-ripple" name="submit" value="Ingresar"> </p>

<?php
// Se muestra el mensaje de error si se cumplen los requisitos
if ($errorLogin){
echo <<<EOT
<p style="color: red"> $mensajeError </p>
EOT;
}
?>
                </form>

                <footer class="w3-container">
                    <h5>José Colque - 2020</h5>
                </footer>
            </div>
        </div>

        <div class="w3-third w3-margin-bottom">

        </div>

    </div>
</body>

</html>