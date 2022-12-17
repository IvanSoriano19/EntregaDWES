<?php 
session_start();
include ("../libs/bGeneral.php");
include ("../libs/config.php");

/**
 * Comprobamos si estamos logueado en el sistema y si tuviesemos nivel de usuario tb lo haríamos
 * Si hemos accedido a esta página sin estar logueados lo redirigimos al index.php
 * 
 **/    

if ($_SESSION['acceso']!="1")
{
header("Location:index.php");

}
include ("home.php");
// cabecera("Privada");

if (isset($_POST['bSubirImagen'])) {
    echo "hola";
}
?>

