﻿<?php

/****
 * Librería con funciones generales y de validación
 * @author Heike Bonilla
 * 
 */

function cabecera($titulo = "") // el archivo actual
{
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title> <?= $titulo ?> </title>
        <meta charset="utf-8" />
    </head>

    <body>
    <?php
}

function pie()
{
    echo "</body>
	</html>";
}


//***** Funciones de sanitización **** //


/**
 * funcion sinTildes
 *
 * Elimina caracteres con tilde de las cadenas
 * 
 * @param string $frase
 * @return string
 */

function sinTildes($frase): string
{
    $no_permitidas = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "à",
        "è",
        "ì",
        "ò",
        "ù",
        "À",
        "È",
        "Ì",
        "Ò",
        "Ù"
    );
    $permitidas = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}

/**
 * Funcion sinEspacios
 * 
 * Elimina los espacios de una cadena de texto
 * 
 * @param string $frase
 * @param string $espacio
 * @return string
 */

function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}


/**
 * Funcion recoge
 * 
 * Sanitiza cadenas de texto
 * 
 * @param string $var
 * @return string
 */

function recoge(string $var)
{
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    } else
        $tmp = "";

    return $tmp;
}

//funcion para recoger el string con espacios
function recogeLimpio(string $var)
{
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = strip_tags($var);
    } else
        $tmp = "";

    return $tmp;
}

/**
 * Funcion recogeArray
 * 
 * Sanitiza arrays
 * 
 * @param string $var
 * @return array
 */

function recogeArray(string $var): array
{
    $array = [];
    if (isset($_REQUEST[$var]) && (is_array($_REQUEST[$var]))) {
        foreach ($_REQUEST[$var] as $valor)
            $array[] = strip_tags(sinEspacios($valor));
    }

    return $array;
}



//***** Funciones de validación **** //

/**
 * Funcion cTexto
 *
 * Valida una cadena de texto con respecto a una RegEx. Reporta error en un array.
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param integer $min
 * @param integer $max
 * @param bool $espacios
 * @param bool $case
 * @return bool
 */


function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE): bool
{
    $case = ($case === TRUE) ? "i" : "";
    $espacios = ($espacios === TRUE) ? " " : "";
    if ((preg_match("/^[a-zñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

//***** Funciones de validación **** //

/**
 * Funcion cNum
 *
 * Valida que un string sea numerico menor o igual que un número y si es o no requerido
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param bool $requerido
 * @param integer $max
 * @return bool
 */
function cNum(string $num, string $campo, array &$errores, bool $requerido = TRUE, int $max = PHP_INT_MAX): bool
{
    $cuantificador = ($requerido) ? "+" : "*";
    if ((preg_match("/^[0-9]" . $cuantificador . "$/", $num))) {

        if ($num <= $max) return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

/**
 * Funcion cRadio
 *
 * Valida que un string se encuentre entre los valores posibles. Si es requerido o no
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param array $valores
 * @param bool $requerido
 * 
 * @return boolean
 */
function cRadio(string $text, string $campo, array &$errores, array $valores)
{
    if (in_array($text, $valores)) {
        return true;
    }
    if ($text == "") {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

/**
 * Funcion cCheck
 *
 * Valida que los valores seleccionado en un checkbox array están dentro de los 
 * valores válidos dados en un array. Si es requerido o no
 * 
 * 
 * @param array $text
 * @param string $campo
 * @param array $errores
 * @param array $valores
 * @param bool $requerido
 * 
 * @return boolean
 */

function cCheck(array $text, string $campo, array &$errores, array $valores, bool $requerido = TRUE)
{

    if (($requerido) && (count($text) == 0)) {
        $errores[$campo] = "Error en el campo $campo";
        return false;
    }
    foreach ($text as $valor) {
        if (!in_array($valor, $valores)) {
            $errores[$campo] = "Error en el campo $campo";
            return false;
        }
    }
    return true;
}

/* Por defecto es no sensible a mayúsculas, permite un espacio entre palabras y cadenas de longitud entre 1 y 30 */
function cUsuario(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, string $case = "i")
{
    if ((preg_match("/^[A-Za-zÑñ0-9\*\+\_\-]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {

        return true;
    }
    $errores[$campo] = "El $campo sólo puede contener letras";
    return false;
}


function cPassword(string $text, string $campo, array &$errores, int $max = 15, int $min = 4, string $case = "i")
{
    $regex = "/[A-Za-zÑn0-9\*\_\-\\$\&\/\\\\\\+]{" . $min . "," . $max . "}$/u$case";
    if ((preg_match($regex, sinTildes($text)))) {

        return true;
    }
    $errores[$campo] = "El $campo sólo puede contener letras";
    return false;
}

/*
 * Función que valida fechas.
 * Por defecto en formato dd-mm-aaa. Caso 1 mm/dd/aaaa. Caso 2 aaaa/mm/dd
 * Ponemos como caso por defecto el que utilice nuestro formulario
 * Permite separador / o -
 */
function cFecha(string $text, string $campo, array &$errores, string $formato = "0")
{
    $arrayFecha = preg_split("/[-]/", $text);

    if (count($arrayFecha) == 3) {
        switch ($formato) {
            case ("0"):
                //formato dia mes ano
                // $fechaDMA = checkdate($arrayFecha[0], $arrayFecha[1], $arrayFecha[2]);
                $fechaDMA = $arrayFecha[2] ."-". $arrayFecha[1] ."-". $arrayFecha[0];
                return $fechaDMA;
                break;

            case ("1"):
                return checkdate($arrayFecha[0], $arrayFecha[1], $arrayFecha[2]);
                break;

            case ("2"):
                return checkdate($arrayFecha[1], $arrayFecha[2], $arrayFecha[0]);
                break;
            default:
                $errores[$campo] = "El $campo tiene errores";
                return false;
        }
    } else {
        $errores[$campo] = "El $campo tiene errores";
        return false;
    }
}


/**
 * Funcion cFile
 * 
 * Valida la subida de un archivo a un servidor.
 *
 * @param string $nombre
 * @param array $extensiones_validas
 * @param string $directorio
 * @param integer $max_file_size
 * @param array $errores
 * @param boolean $required
 * @return boolean|string
 */
function cFile(string $nombre, array &$errores, array $extensionesValidas, string $directorio, int  $max_file_size,  bool $required = TRUE)
{
    // Caso especial que el campo de file no es requerido y no se intenta subir ningun archivo
    if ((!$required) && $_FILES[$nombre]['error'] === 4)
        return true;
    // En cualquier otro caso se comprueban los errores del servidor 
    if ($_FILES[$nombre]['error'] != 0) {
        $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
        echo "<script>console.log('errores: " . $errores["$nombre"] . "' );</script>";
        return false;
    } else {

        $nombreArchivo = strip_tags($_FILES["$nombre"]['name']);
        echo "<script>console.log('nombreArchivo: " . $nombreArchivo . "' );</script>";
        /*
             * Guardamos nombre del fichero en el servidor
            */
        $directorioTemp = $_FILES["$nombre"]['tmp_name'];
        // echo "<script>console.log('directorioTemp: " . $directorioTemp . "' );</script>";
        /*
             * Calculamos el tamaño del fichero
            */
        $tamanyoFile = filesize($directorioTemp);
        echo "<script>console.log('tamanyoFile: " . $tamanyoFile . "' );</script>";
        
        /*
            * Extraemos la extensión del fichero, desde el último punto.
            */
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
        echo "<script>console.log('extension: " . $extension . "' );</script>";

        /*
            * Comprobamos la extensión del archivo dentro de la lista que hemos definido al principio
            */
        if (!in_array($extension, $extensionesValidas)) {
            $errores["$nombre"] = "La extensión del archivo no es válida";
            echo "<script>console.log('errores: " . $errores["$nombre"] . "' );</script>";
            return false;
        }
        /*
            * Comprobamos el tamaño del archivo
            */
        if ($tamanyoFile > $max_file_size) {
            $errores["$nombre"] = "La imagen debe de tener un tamaño inferior a $max_file_size kb";
            echo "<script>console.log('errores: " . $errores["$nombre"] . "' );</script>";
            return false;
        }

        // Almacenamos el archivo en ubicación definitiva si no hay errores ( al compartir array de errores TODOS LOS ARCHIVOS tienen que poder procesarse para que sea exitoso. Si cualquiera da error, NINGUNO  se procesa)

        if (empty($errores)) {
            /**
             * Comprobamos si el directorio pasado es válido
             */
            if (is_dir($directorio)) {
                /**
             * Tenemos que buscar un nombre único para guardar el fichero de manera definitiva.
             * Podemos hacerlo de diferentes maneras, en este caso se hace añadiendo microtime() al nombre del fichero 
             * si ya existe un archivo guardado con ese nombre.
             * */
                echo "<script>console.log('is_dir: true' );</script>";
                $nombreArchivo = is_file($directorio . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
                echo "<script>console.log('nombreArchivo: " . $nombreArchivo . "' );</script>";
                $nombreCompleto = $directorio . DIRECTORY_SEPARATOR . $nombreArchivo;
                echo "<script>console.log('nombreCompleto: " . $nombreCompleto . "' );</script>";
                /**
                 * Movemos el fichero a la ubicación definitiva.
                 * */
                if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                    /**
                     * Si todo es correcto devuelve la ruta y nombre del fichero como se ha guardado
                     */


                    echo "<script>console.log('move_uploaded_file: true' );</script>";
                    return $nombreCompleto;
                } else {
                    $errores["$nombre"] = "Ha habido un error al subir el fichero";
                    echo "<script>console.log('errores 1: " . $errores["$nombre"] . "' );</script>";
                    return false;
                }
            }else {
                $errores["$nombre"] = "Ha habido un error al subir el fichero";
                echo "<script>console.log('errores 2: " . $errores["$nombre"] . "' );</script>";
                return false;
            }
        }
    }
}

    ?>