<?php
include("../libs/bGeneral.php");
session_start();
/**
 * Destuimos las variables y la sesión
 **/

echo "Nos vemos pronto ". $_SESSION['usuario']. "<br>";

session_unset ();
session_destroy();
cabecera("Comprobar");
echo "Ha salido del sistema<br>";
echo "<a href=index.php>Volver al inicio</a>";
?>