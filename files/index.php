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
    //recogemos y comprobamos usuario

    // $nameLogin = comprobarLoginUsuario(recoge("nombre"));
    // $pass = comprobarLoginClave(recoge("clave"));

    // if ($nameLogin && $pass) {
    if ((comprobarLoginUsuario(recoge("nombre"))) && (comprobarLoginClave(recoge("clave")))) {
        /*
    * Inicializamos variables de sesión. En caso de tener guardaríamos también nivel de usuario
    * En la variable acceso guardamos 1 si el usuario se ha logueado.
    */
        $_SESSION['acceso'] = 1;
        $_SESSION['usuario'] = 'root';
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
    $usuario = recoge("usuario"); //? hay que hacer que contenga letras, numeros y _ . Maximo 12
    $clave = recoge("clave"); //? letras, numeros, y caracteres raros de esos, max 15
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
    
}

