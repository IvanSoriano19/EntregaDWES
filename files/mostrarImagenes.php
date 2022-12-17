<?php
session_start();

require '../libs/bGeneral.php';
require '../libs/componentes.php';

cabecera("Ejercicio1");

$carpeta = recoge("categoria");

$directory="../img/".$_SESSION['usuario'];
if ($carpeta !== "General") {
    $directory .= "/".$carpeta;
}

$elementos=devuelveFicheros("$directory");

mostrarTabla($elementos);

echo "<a href=privada.php>Volver a home</a>";

pie();

?>
