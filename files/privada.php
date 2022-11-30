<?php 
session_start();
include ("../libs/bGeneral.php");

/**
 * Comprobamos si estamos logueado en el sistema y si tuviesemos nivel de usuario tb lo haríamos
 * Si hemos accedido a esta página sin estar logueados lo redirigimos al index.php
 * 
 **/    

if ($_SESSION['acceso']!="1")
{
header("Location:index.php");

}
cabecera("Privada");
echo "Bienvenido a la página privada ";
echo $_SESSION['usuario'];

/**
 * Ponemos un enlace que nos lleva a la página donde se cierra sesión
 */
echo "<br><a href=login.php>Salir del sistema</a>";
?>

