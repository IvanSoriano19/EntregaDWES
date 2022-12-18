<?php

function printDesplegable(array $valores, string $nombre)
{

    echo '<select name="' . $nombre . '" required>';
    foreach ($valores as $value) {
        echo '<option value="' . $value . '">' . $value . '</option>';
    }
    echo '</select>';
}

function printCheck(array $valores, string $nombre)
{
    echo "<label required>";
    foreach ($valores as $valor) {
        echo '<input type="checkbox" name="' . $nombre . '[]" value=' . $valor . '>' . $valor . '<br>';
    }
    echo "</label>";
}

function darAlta($usuario, $ruta = "../usuarios.txt")
{
    if (is_file($ruta)) {
        if ($archivo = fopen($ruta, "a")) {
            fwrite($archivo, $usuario . PHP_EOL);
            fclose($archivo);
            return true;
        } else {
            return false;
        }
    }
}

function comprobarLoginUsuario($name, $ruta = "../usuarios.txt")
{
    if (is_file($ruta)) {
        if ($archivo = fopen($ruta, "r")) {
            while (!feof($archivo)) {
                $contenido = fgets($archivo);
                $usuario = explode("/", $contenido);
                $nombres[] = $usuario[2];
            }
            fclose($archivo);
        }
        foreach ($nombres as $nombre) {
            if ($nombre === $name) {
                return true;
            }
        }
    }
}

function comprobarLoginClave($clave, $ruta = "../usuarios.txt")
{
    if (is_file($ruta)) {
        if ($archivo = fopen($ruta, "r")) {
            while (!feof($archivo)) {
                $contenido = fgets($archivo);
                $usuario = explode("/", $contenido);
                $claves[] = $usuario[3];
            }
            fclose($archivo);
        }
        foreach ($claves as $pass) {
            if ($pass === $clave) {
                return true;
            }
        }
    }
}



/**
 * 
 * funcion devuelveFicheros
 * Función que recorre y devuelve un array con el nombre de los archivos contenidos en un directorio.
 * Realiza una función devuelveFicheros que recorre un directorio devolviendo los nombres de los archivos que contiene, 
 * sólo nombre de los archivos no directorios. 
 * Devolvemos un array y false en caso de error.
 * 
 * @param string $path
 * @return array|bool
 */

function devuelveFicheros($path)
{
    if (is_dir($path)) {
        $arbol = [];
        if ($dir = opendir($path)) {
            while ($elemento = readdir($dir)) {
                if (is_file($path .DIRECTORY_SEPARATOR. $elemento)) {
                    $arbol[] = $path .DIRECTORY_SEPARATOR. $elemento;
                }
            }
            closedir($dir);
            // Sino es un directorio o no se ha podido abrir devuelve false
            return $arbol;
        }
    }

    return false;
}


// muestra una tabla con las imagenes del array
function mostrarTabla($ficheros)
{
    echo "<table>";
    for ($i = 0; $i < count($ficheros); $i += 2) {
        echo "<tr>";
        echo '<td><img src="' . $ficheros[$i] . '" style="width:200px"></td>';
        if ($i + 1 != count($ficheros))
            echo '<td><img src="' . $ficheros[$i + 1] . '" style="width:200px"></td>';
        echo "</tr>";
    }
    echo "</table>";
}