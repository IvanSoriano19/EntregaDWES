
<?php 
foreach ($errores as $error) {
    echo "<br>Error: " . $error . "<br>";
}
?>
    <h1>LOGIN</h1>
    <p>root, super</p>
    <FORM METHOD=POST ACTION=index.php>
        <p>Usuario: <INPUT TYPE=TEXT NAME=usuario></p>
        <p>Contraseña: <INPUT TYPE=PASSWORD NAME=clave></p>
        <p>
            <INPUT TYPE="SUBMIT" NAME="bAceptar" VALUE="Aceptar">
            <a href="registro.php"><INPUT TYPE="button" NAME="registro" VALUE="Registrate"></a>
        </p>
    </FORM>
</body>

</html>