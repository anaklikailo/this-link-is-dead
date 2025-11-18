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

    <div class="about">
        <h2>Acerca de.</h2>
        <p>Bienvenid@! Este es un sitio web tributo dedicado a la banda de metal/rock alternativo Deftones, 
            creada por una fanática del grupo para compartir informacion sobre su discografia, aportando detalles sobre sus álbumes
            y canciones. Accedé a la misma a través de la seccion 'Discografía'. Hay un apartado de 'Contacto' para en el que podés 
            enviar sugerencias o consultas relacionadas con la banda o el sitio web en sí. </p>
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