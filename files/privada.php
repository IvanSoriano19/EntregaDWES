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
cabecera("Privada");
echo "Bienvenido a la página privada ";
echo $_SESSION['usuario'];

echo '<br><input type="file" name="file" style="margin-right: 10px; margin-top: 10px;">';
if (is_array($categorias)) {
    foreach ($categorias as $c){
        echo '<input type="checkbox" name="categoria[]" value="'.$c.'" style="margin-top: 10px;"><span style="margin-right: 10px;">'.$c.'</span>';
    }
}
echo '<a href="subirImagen.php"><input type="button" name="subirImagen" value="Subir imagen" style="margin-top: 10px;"></a>';

echo '<hr>';

echo '<input type=button name=bGeneral value=General style="margin-right: 10px;" onclick="recoge("General");" >';
if (is_array($categorias)) {
    foreach ($categorias as $c){
        echo '<input type=button name=b'.$c.' value='.$c.' style="margin-right: 10px;">';
    }
}

// function showImages($carpeta){
//     // $directory="img/".$_SESSION['usuario'];
//     // if ($carpeta !== "General") {
//     //     $directory .= "/".$carpeta;
//     // }
//     // echo "<script>console.log(".$directory.");</script>";
//     // $dirint = dir($directory);
//     // while (($archivo = $dirint->read()) !== false)
//     // {
//     //     if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("jpeg", $archivo)){
//     //         echo "<script>console.log('<img src='".$directory."/".$archivo."'>');</script>";
//     //         echo '<img src="'.$directory."/".$archivo.'">'."\n";
//     //     }
//     // }
//     // $dirint->close();
// }

/**
 * Ponemos un enlace que nos lleva a la página donde se cierra sesión
 */
echo "<br><br><a href=login.php>Salir del sistema</a>";
?>

