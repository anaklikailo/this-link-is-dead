<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../login.php');
    exit();
}

include('../../includes/conexion.php');
conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administracion albumes</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page">
    <header></header>
    
    <div class="form">
        <h2 class="form-title">MENSAJES</h2>
        <div class="button-center">
            <a href="album/admin-album.php" class="table-button admin-table-button">Volver</a>
        </div>
        <?php
        
        $mensajes = mysqli_query($con,"SELECT idContacto,email,nombre,apellido,telefono,direccion,ciudad,pais,falbum,mensaje,fechaAlta FROM contacto ORDER BY fechaAlta DESC");
        while($mensaje = mysqli_fetch_assoc($mensajes)){
            echo "<div class='contact-message-box'>";
                echo "<p><strong>ID:</strong> ".$mensaje['idContacto']."</p>";
                echo "<p><strong>Nombre:</strong> ".$mensaje['nombre']." ".$mensaje['apellido']."</p>";
                echo "<p><strong>Email:</strong> ".$mensaje['email']."</p>";
                echo "<p><strong>Teléfono:</strong> ".$mensaje['telefono']."</p>";
                echo "<p><strong>Dirección:</strong> ".$mensaje['direccion'].", ". $mensaje['ciudad'].", ".$mensaje['pais']."</p>";
                echo "<p><strong>Álbum Favorito:</strong> ".$mensaje['falbum']."</p>";
                echo "<p><strong>Mensaje:</strong> ".$mensaje['mensaje']."</p>";
                echo "<p><strong>Fecha de Envío:</strong> ".$mensaje['fechaAlta']."</p>";
            echo "</div>";
            }
        ?>
    </div>
</body>
</html>