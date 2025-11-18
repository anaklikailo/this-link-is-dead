<?php
include('../includes/conexion.php');
conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Álbum</title>
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="page">
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="../index.php">Inicio</a></li> 
                <li><a href="discografia.php">Discografía</a></li> <!-- listado-box.html -->
                <li><a href="contacto.php">Contacto</a></li> <!-- comprar.html -->
            </ul>
        </nav>
    </header>

    <?php
    $albumes = mysqli_query($con, "SELECT portada,tituloAlbum,fecha FROM album where idAlbum=" . $_GET['idx']);

    if($album = mysqli_fetch_assoc($albumes)){
        echo "<div class='album-item'>";
            echo "<div class='album-pic-info'>";
                echo "<img src= '../" . $album['portada'] . "' alt=" . $album['tituloAlbum']."'>";
                echo "<h2>" . $album['tituloAlbum'] . "</h2>";
                echo "<p>" . $album['fecha'] . "</p>";
            echo "</div>";
            echo "<div class='album-songs'>";
                echo "<h3>Canciones:</h3>";
                echo "<ol>";
                $canciones = mysqli_query($con, "SELECT tituloCancion,glosa FROM cancion where idAlbum=" . $_GET['idx']);
                while($cancion = mysqli_fetch_assoc($canciones)){
                    echo "<li>" . $cancion['tituloCancion'];
                    if ($cancion['glosa'] != NULL) {
                        echo "<div class='song-info'>Nota:<br>" . $cancion['glosa'] . "</div>";
                    }
                    echo "</li>";
                }
            echo "</div>";
        echo "</div>";
    }
    ?>    
</body>
</html>
