<?php 
session_start();
include ("../libs/bGeneral.php");
include ("../libs/config.php");

$error = false;
$errores = [];
$foto = "";

/**
 * Comprobamos si estamos logueado en el sistema y si tuviesemos nivel de usuario tb lo haríamos
 * Si hemos accedido a esta página sin estar logueados lo redirigimos al index.php
 * 
 **/    

if ($_SESSION['acceso']!="1"){
    header("Location:index.php");
}
// cabecera("Privada");

if (isset($_POST['bSubirImagen'])) {
    $categoria = recoge("categoria");
    if (!cRadio($categoria, "categoria", $errores, $categorias)) {
        $errores['categoria'] = 'La categoria no es correcta';
        $error = true;
    }

    if ($categoria == "") {
        $rutaGuardado = "../".$rutaImagenes."/".$_SESSION['usuario']; 
    } else {
        $rutaGuardado = "../".$rutaImagenes."/".$_SESSION['usuario']."/".$categoria; 
    }
    
    if (!is_dir($rutaGuardado)) {
        mkdir($rutaGuardado, 0777);
    }
    
    
    $nuevaFoto = cFile("foto", $errores, $extensionesValidas, $rutaGuardado, $maxFichero, true);
    if (!$nuevaFoto) {
        $errores['foto'] = 'La foto no tiene un formato o tamaño admitido';
        $error = true;
    }
    
    include('home.php');
} else{
    include("home.php");
}
?>
