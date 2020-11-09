<?php
// Se retorna a la ventana de inicio de sesión en el cierre de sesión.
echo <<<EOT
<script>
alert('Hasta luego');
window.location.href="../index.php";
</script>
EOT;
?>