<?php
include('./includes/conexion.php');
conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>This link is dead</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="index.php">Inicio</a></li> 
                <li><a href="pages/discografia.php">Discografía</a></li>
                <li><a href="pages/contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <div class="front-page-container">
        <img src="/this-link-is-dead/images/portada.jpg" class="front-page">
        <h1>This link is dead</h1>
    </div>
    

    <div class="table-list-container">
        <h2>Stream de los álbumes en Spotify.</h2>
        <p>Segun kworb.net.</p>
        <table class ="table-list">
            <?php
            $albumes = mysqli_query($con, "SELECT idAlbum, tituloAlbum, stream FROM album ORDER BY stream DESC");
            $contador = 1;
            while($album = mysqli_fetch_assoc($albumes)){
                echo "<tr>";
                echo "<td>" . $contador . "</td>";
                echo "<td>" . $album['tituloAlbum'] . "</td>";
                echo "<td>" . $album['stream'] . "</td>";
                echo "<td><a href='pages/album.php?idx=" . $album['idAlbum'] . "' class='table-button'>ver mas</a></td>";
                echo "</tr>";
                $contador++;
            }
            ?>
        </table>
        <p>Actualización de valores todos los domingos 22:00hs UTC-3.</p>
    </div>
</body>
</html>