<?php
session_start();
include('../../includes/conexion.php');
conectar();

if (isset($_GET['tipo']) && isset($_GET['id'])){
    $id = (int)$_GET['id'];
    
    if ($_GET['tipo'] == 'album') {
        mysqli_query($con,"DELETE FROM cancion WHERE idAlbum = $id");
        mysqli_query($con,"DELETE FROM album WHERE idAlbum = $id");
        echo "<script>alert('Album eliminado.');
        window.location='album/admin-album.php';</script>";
        exit;
    } else if ($_GET['tipo'] == 'cancion') {
        $id_album = (int)$_GET['id_album'];
        mysqli_query($con, "DELETE FROM cancion WHERE idCancion = $id");
        echo "<script>alert('Canción eliminada.');
        window.location='cancion/admin-canciones.php?id=$id_album';</script>";
        exit();
    }
}
?>