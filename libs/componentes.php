<?php

function printDesplegable(array $valores, string $nombre){

    echo '<select name="'.$nombre.'" required>';
        foreach ($valores as $value) {
            echo '<option value="'.$value.'">'.$value.'</option>';
        }
    echo '</select>';
    
}

function printCheck(array $valores, string $nombre){
    echo "<label required>";
    foreach ($valores as $valor) {
        echo '<input type="checkbox" name="'.$nombre.'[]" value='.$valor.'>'.$valor.'<br>';
    }
    echo "</label>";
}