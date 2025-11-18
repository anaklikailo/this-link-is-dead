<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../login.php');
    exit();
}

include('../../../includes/conexion.php');
conectar();

$id = $_GET['id'] ?? null;
$mensaje = '';
$registro = null;
$titulo_pagina = 'Agregar Álbum';

if ($id) {
    $registro = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM album WHERE idAlbum = $id"));
    if (!$registro) {
        header('Location: admin-album.php');
        exit();
    }
    $titulo_pagina = 'Modificar Álbum';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($con, $_POST['tituloAlbum']);
    $fecha = mysqli_real_escape_string($con, $_POST['fecha']);
    $stream = mysqli_real_escape_string($con, $_POST['stream']);
    $portada = $_FILES['portada']['name'];

    if($portada!="" && is_uploaded_file($_FILES['portada']['tmp_name'])){
        $trozos = explode(".", $portada);
        $fechaFoto = time();
        copy($_FILES['portada']['tmp_name'], "../../../images/".$fechaFoto.".".end($trozos));
        $portada_final = "images/" . $fechaFoto . "." . end($trozos);
    } else {
        $portada_final = "";
    }

    if ($id) {
        $sql = "UPDATE album SET tituloAlbum='$titulo', fecha='$fecha', stream='$stream', portada='$portada_final' WHERE idAlbum=$id";
        $msg = "Álbum actualizado correctamente";
    } else {
        $sql = "INSERT INTO album (tituloAlbum, fecha, stream, portada) VALUES ('$titulo', '$fecha', '$stream', '$portada_final')";
        $msg = "Álbum agregado correctamente";
    }
    
    if (mysqli_query($con, $sql)) {
        $mensaje = $msg;
    } else {
        $mensaje = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="stylesheet" href="../../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page">
    <header></header>

    <form class="form" method="POST" action="form-album.php<?php echo $id ? '?id=' . $id : ''; ?>" enctype="multipart/form-data">
        <?php if ($mensaje){
            echo "<p class='form-success'> " . $mensaje . "</p>";
        }; ?>
        
        <h2 class="form-title"><?php echo $titulo_pagina; ?></h2>
        <div class="button-center">
            <a href="admin-album.php" class="table-button admin-table-button">Volver</a>
        </div>
        <input class="form-input" type="text" name="tituloAlbum" placeholder="Título" value="<?php echo $registro['tituloAlbum'] ?? ''; ?>" required>
        <input class="form-input" type="date" name="fecha" placeholder="Fecha" value="<?php echo $registro['fecha'] ?? ''; ?>" required>
        <input class="form-input" type="number" name="stream" placeholder="Stream" value="<?php echo $registro['stream'] ?? ''; ?>">
        <input class="form-input" type="file" name="portada" required>     
        <input class="form-input form-input-button" type="submit" value="<?php echo $id ? 'Guardar' : 'Agregar'; ?>">
    </form>
</body>
</html>
