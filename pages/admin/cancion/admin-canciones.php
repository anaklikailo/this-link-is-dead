<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../login.php');
    exit();
}

include('../../../includes/conexion.php');
conectar();

$id_album = $_GET['id'] ?? null;

if (!$id_album) {
    header('Location: ../album/admin-album.php');
    exit();
}

// Obtener datos del álbum
$album = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM album WHERE idAlbum = $id_album"));

if (!$album) {
    header('Location: ../album/admin-album.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Canciones - <?php echo $album['tituloAlbum']; ?></title>
    <link rel="stylesheet" href="../../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page">
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="../album/admin-album.php">Volver</a></li>
                <li><a href="form-cancion.php?id_album=<?php echo $id_album; ?>">Agregar Canción</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="form">
        <h2 class="form-title">Canciones - <?php echo $album['tituloAlbum']; ?></h2>
        <?php
        echo "<table class='admin-table'>";
        echo "<tr><th><p>ID</p></th><th><p>Título</p></th><th><p>Glosa</p></th><th><p>Modificar</p></th><th><p>Eliminar</p></th></tr>";
        
        $canciones = mysqli_query($con, "SELECT idCancion, tituloCancion, glosa FROM cancion WHERE idAlbum = $id_album");

        while($cancion = mysqli_fetch_assoc($canciones)){
            echo "<tr>";
            echo "<td>".$cancion['idCancion']."</td>";
            echo "<td>".$cancion['tituloCancion']."</td>";
            echo "<td>".$cancion['glosa']."</td>";
            echo "<td><a href='form-cancion.php?id_album=".$id_album."&id=".$cancion['idCancion']."' class='table-button'>Modificar</a></td>";
            echo "<td><a href='../eliminar.php?tipo=cancion&id=".$cancion['idCancion']."&id_album=".$id_album."' class='table-button'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>
