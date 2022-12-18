<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Home</title>
</head>

<body>
    <h1>HOME</h1>
    <form method=post action=privada.php enctype="multipart/form-data">
        Bienvenido a la página privada 
        <?php 
            echo $_SESSION['usuario'];
            $usuario = $_SESSION['usuario'];
            var_dump(is_file("../img/fotosPerfil/'.$usuario.'.jpg"));
            echo '<img src="../img/fotosPerfil/'.$usuario.'.jpg" width="50px" height="50px" >';
            if (is_file("../img/fotosPerfil/'.$usuario.'.jpg")) {
                echo '<img src="../img/fotosPerfil/'.$usuario.'.jpg" width="50px" height="50px" style="position: absolute; top: 10px; right: 10px">';
            } else {
                echo "hola";
                echo '<img src="../img/fotosPerfil/default.jpg" width="50px" height="50px" style="position: absolute; top: 10px; right: 10px">';
            }

            ?>
        <br>
        
        <input type="file" name="foto" value="<?= isset($foto) ? $foto : ""; ?>" style="margin-right: 10px; margin-top: 10px;">
        <?php
            if (is_array($categorias)) {
                foreach ($categorias as $c){
                    echo '<input type="radio" name="categoria" value="'.$c.'" style="margin-top: 10px;"><span style="margin-right: 10px;">'.$c.'</span>';
                }
            }
        ?>
        <input type="submit" name="bSubirImagen" value="Subir imagen" style="margin-top: 10px;">
        <br>

        <?php
            echo (isset($errores['foto'])) ? "$errores[foto] <br>" : "";
            echo (isset($errores['categoria'])) ? "$errores[categoria] <br>" : "";
        ?>

        <hr>

        <?php
            echo '<a href="mostrarImagenes.php?categoria=General"><input type=button name=bGeneral value=General style="margin-right: 10px;"></a>';
            if (is_array($categorias)) {
                foreach ($categorias as $c){
                    echo '<a href="mostrarImagenes.php?categoria='.$c.'"><input type=button name=b'.$c.' value='.$c.' style="margin-right: 10px;" onclick="showImages('.$c.')"></a>';
                }
            }
        ?>

        <br><br>
        
        <a href=salir.php>Salir del sistema</a>
    </form>
</body>

</html>