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
