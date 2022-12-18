<?php
include("../libs/bGeneral.php");
include("../libs/config.php");
include("../libs/componentes.php");

session_start();
/*
*Sino se ha logueado el usuario iniciamos sesión y ponemos a usuario no logueado
*/

$errores = [];
if (!isset($_SESSION['acceso'])) {
    $_SESSION['acceso'] = 0;
}
cabecera("Comprobar");

if (isset($_POST['bAceptar'])) {
    
    if ((comprobarLoginUsuario(recoge("usuario"))) && (comprobarLoginClave(recoge("clave")))) {
        /*
    * Inicializamos variables de sesión. En caso de tener guardaríamos también nivel de usuario
    * En la variable acceso guardamos 1 si el usuario se ha logueado.
    */
        $_SESSION['acceso'] = 1;
        $_SESSION['usuario'] = recoge("usuario");
        header("location:privada.php");
    } else {
        echo "El nombre o contraseña son incorrectos<br>";
        echo "Si no estas registrado registrate";
    }
}
include("login.php");

if (isset($_POST['bAceptarRegistro'])) {
    $nombre = recoge("nombre");
    $apellido = recoge("apellido");
    $usuario = recoge("usuario"); 
    $clave = recoge("clave"); 
    $localidad = recoge("localidad");
    $provincias = recoge("provincias");
    $fecha = recoge("fecha");
    $aficiones = recogeArray("aficiones");

    $serializeAficiones = serialize($aficiones);

    $fechaDMA = cFecha($fecha, "fecha", $errores, 0);
    cPassword($clave, "clave", $errores);
    cUsuario($usuario, "usuario", $errores);

    $usuarioFile = "$nombre" . "/" . "$apellido" . "/" . "$usuario" . "/" . "$clave" . "/" . "$localidad" . "/" . "$provincias" . "/" . "$serializeAficiones" . "/" . "$fechaDMA";

    darAlta($usuarioFile);

    $rutaPerfil = "../" . $rutaImagenes . "/fotosPerfil";

    $_FILES["imagen"]['name'] = $usuario.".jpg";

    $fotoPerfil = cfile("imagen",  $errores, $extensionesValidas, $rutaPerfil, $maxFichero, false);

    $ruta = "../img/$usuario"; //Verificar el directorio actual
    //Esto es suponiendo que ya está creada la carpeta archivos_subidos
    if (mkdir($ruta, 0777)) {
        mkdir($ruta . "/viajes", 0777);
        mkdir($ruta . "/amigos", 0777);
        mkdir($ruta . "/naturaleza", 0777);
    } else {
        echo "Fallo al crear la subcarpeta";
    }
}
