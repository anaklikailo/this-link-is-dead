<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../login.php');
    exit();
}

include('../../../includes/conexion.php');
conectar();

$id_album = $_GET['id_album'] ?? null;
$id = $_GET['id'] ?? null;
$mensaje = '';
$registro = null;
$titulo_pagina = 'Agregar Canción';

if (!$id_album) {
    header('Location: admin-album.php');
    exit();
}

$album = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM album WHERE idAlbum = $id_album"));
if (!$album) {
    header('Location: admin-album.php');
    exit();
}

if ($id) {
    $registro = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM cancion WHERE idCancion = $id"));
    if (!$registro) {
        header("Location: admin-canciones.php?id=$id_album");
        exit();
    }
    $titulo_pagina = 'Modificar Canción';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($con, $_POST['tituloCancion']);
    $glosa = mysqli_real_escape_string($con, $_POST['glosa']);

    if ($id) {
        $sql = "UPDATE cancion SET tituloCancion='$titulo', glosa='$glosa' WHERE idCancion=$id";
        $msg = "Canción actualizada correctamente";
    } else {
        $sql = "INSERT INTO cancion (idAlbum, tituloCancion, glosa) VALUES ($id_album, '$titulo', '$glosa')";
        $msg = "Canción agregada correctamente";
    }
    
    if (mysqli_query($con, $sql)) {
        $mensaje = $msg;
        if ($id) {
            $registro = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM cancion WHERE idCancion = $id"));
        }
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
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="admin-canciones.php?id=<?php echo $id_album; ?>">Volver</a></li>
            </ul>
        </nav>
    </header>

    <form class="form" method="POST">
        <?php if ($mensaje){
            echo "<p class='form-success'> " . $mensaje . "</p>";
        }; ?>
        
        <h2 class="form-title"><?php echo $titulo_pagina; ?></h2>
        <p><?php echo $album['tituloAlbum']; ?></p>
        <input class="form-input" type="text" name="tituloCancion" placeholder="Título de la canción" value="<?php echo $registro['tituloCancion'] ?? ''; ?>" required>
        <input class="form-input" type="text" name="glosa" placeholder="Glosa" value="<?php echo $registro['glosa'] ?? ''; ?>">
        
        <input class="form-input" type="submit" value="<?php echo $id ? 'Guardar' : 'Agregar'; ?>">
    </form>
</body>
</html>
