<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../login.php');
    exit();
}

include('../../../includes/conexion.php');
conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administracion albumes</title>
    <link rel="stylesheet" href="../../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page">
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="form-album.php">Agregar Álbum</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="form">
        <h2 class="form-title">ALBUMES</h2>
        <?php
        echo "<table class='admin-table'>";
        echo "<tr><th><p>Titulo</p></th><th><p>Fecha</p></th><th><p>Portada</p></th><th><p>Stream</p></th><th><p>Lista de Canciones</p></th><th><p>Modificar</p></th><th><p>Eliminar</p></th></tr>";
        
        $albumes = mysqli_query($con,"SELECT idAlbum,tituloAlbum,fecha,portada,stream FROM album");

        while($album = mysqli_fetch_assoc($albumes)){
            echo "<tr>";
            echo "<td>".$album['tituloAlbum']."</td>";
            echo "<td>".$album['fecha']."</td>";
            echo "<td class='admin-pic'><img src='../../../" . $album['portada'] . "'></td>";
            echo "<td>".$album['stream']."</td>";
            echo "<td><a href='../cancion/admin-canciones.php?id=".$album['idAlbum']."' class='table-button'>Ver Canciones</a></td>";
            echo "<td><a href='form-album.php?id=".$album['idAlbum']."' class='table-button'>Modificar</a></td>";
            echo "<td><a href='../eliminar.php?tipo=album&id=".$album['idAlbum']."' class='table-button'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>