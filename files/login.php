<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login</title>
</head>

<body>
    <h1>LOGIN</h1>
    <p>root, super</p>
    <FORM METHOD=POST ACTION=index.php>
        Nombre: <INPUT TYPE=TEXT NAME=nombre>
        Contraseña: <INPUT TYPE=PASSWORD NAME=clave>
        <INPUT TYPE="SUBMIT" NAME="bAceptar" VALUE="Aceptar">
        <a href="registro.php"><INPUT TYPE="button" NAME="registro" VALUE="Registrate"></a>
<?php
$regex = '/[A-Za-zÑn0-9\*\_\-\$\&\/\'.\\+]{1,15}$/u';

echo"$regex";
?>
        
    </FORM>
</body>

</html>