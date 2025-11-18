<?php
include('../includes/conexion.php');
conectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Discografía</title>
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page">
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="discografia.php">Discografía</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <h2>Álbumes de estudio.</h2>
    <div class="album-box-container" id="albumBoxContainer">
        <?php
        $albumes = mysqli_query($con, "SELECT idAlbum, portada FROM album");
        while($album = mysqli_fetch_assoc($albumes)){
            echo "<a href='album.php?idx=" . $album['idAlbum'] . "'>";
            echo "<div class='album-box' style='background-image: url(../" . $album['portada'] . ");'>";
            echo "</div>";
            echo "</a>";
        }
        ?>
    </div>
</body>
</html>