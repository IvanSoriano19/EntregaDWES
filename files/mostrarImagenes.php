<?php
session_start();

require '../libs/bGeneral.php';
require '../libs/componentes.php';

cabecera("Ejercicio1");

$carpeta = recoge("categoria");

$directory = "../img/" . $_SESSION['usuario'];
if ($carpeta !== "General") {
    $directory .= "/" . $carpeta;
}

$usuario = $_SESSION['usuario'];

echo '<img src="../img/fotosPerfil/' . $usuario . '.jpg" width="50px" height="50px" style="position: absolute; top: 10px; right: 10px">';

$elementos = devuelveFicheros("$directory");

mostrarTabla($elementos);

echo "<a href=privada.php>Volver a home</a>";

pie();
