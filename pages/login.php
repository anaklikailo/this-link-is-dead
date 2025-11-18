<?php
session_start();
include('../includes/conexion.php');
conectar();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';

    if ($usuario && $clave) {
        $registro = mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuario LIMIT 1")) > 0;

        if (!$registro) {
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            mysqli_query($con, "INSERT INTO usuario (nombre, clave) VALUES ('$usuario', '$hash')");
        }

        $sql = mysqli_query($con, "SELECT * FROM usuario WHERE nombre = '$usuario'");
        $usuarioDB = mysqli_fetch_assoc($sql);

        if ($usuarioDB && password_verify($clave, $usuarioDB['clave'])) {
            $_SESSION['usuario'] = $usuarioDB['nombre'];
            $_SESSION['id'] = $usuarioDB['idUsuario'];
            header('Location: admin/album/admin-album.php');
            exit();
        } else {
            $error = 'Usuario o contraseña incorrectos';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administracion</title>
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="page">
    <div class="form">
        <h2 class="form-title">Iniciar Sesión</h2>
        <?php if ($error) {
            echo "<p class='error'>" . $error . "</p>";
            }
        ?>
        <form method="POST" action ="login.php">
            <input type="text" name="usuario" class="form-input" placeholder="Usuario" required>
            <input type="password" name="clave" class="form-input" placeholder="Contraseña" required>
            <input type="submit" id="form-submit" value="Ingresar" class="form-input">
        </form>
    </div>
    </body>
</html>