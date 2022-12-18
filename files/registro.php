<?php

include("../libs/bGeneral.php");
include("../libs/componentes.php");
include("../libs/config.php");

cabecera("Registro");

?>
<h1>Registro</h1>
<FORM METHOD=POST ACTION=index.php enctype="multipart/form-data">
    <p>Nombre: <INPUT TYPE=TEXT NAME=nombre required></p>
    <p>Apellido: <INPUT TYPE=TEXT NAME=apellido required></p>
    <p>Nombre Usuario: <INPUT TYPE=TEXT NAME=usuario required></p>
    <p>Contraseña: <INPUT TYPE=PASSWORD NAME=clave required></p>
    <p>Localidad de residencia <input type="text" name="localidad"></p>
    <p>
        Provincia 
        <?php
            printDesplegable($provincias, "provincias");
        ?>
    </p>

    <p>Fecha de nacimiento <input type="date" name="fecha"></p>

    <p>
        Aficiones: <br>
        <?php
            printCheck($aficiones, "aficiones");
        ?>
    </p>

    <p>
    Foto Perfil: <input type="file" name="imagen" id="imagen"/>
    </p>

    <INPUT TYPE="SUBMIT" NAME="bAceptarRegistro" VALUE="Aceptar">
</FORM>