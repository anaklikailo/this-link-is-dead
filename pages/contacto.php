<?php
include('../includes/conexion.php');
conectar();
$enviado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $fname = mysqli_real_escape_string($con, $_POST['fname'] ?? '');
    $lname = mysqli_real_escape_string($con, $_POST['lname'] ?? '');
    $phone = mysqli_real_escape_string($con, $_POST['phone'] ?? '');
    $address = mysqli_real_escape_string($con, $_POST['address'] ?? '');
    $city = mysqli_real_escape_string($con, $_POST['city'] ?? '');
    $country = mysqli_real_escape_string($con, $_POST['country'] ?? '');
    $falbum = mysqli_real_escape_string($con, $_POST['falbum'] ?? '');
    $mensaje = mysqli_real_escape_string($con, $_POST['mensaje']);

    
    if (mysqli_query($con, "INSERT INTO contacto(email, nombre, apellido, telefono, direccion, ciudad, pais, falbum, mensaje) 
            VALUES ('$email', '$fname', '$lname', '$phone', '$address', '$city', '$country', '$falbum', '$mensaje')")) {
        $enviado = "Gracias por contactarte! Tu mensaje ha sido enviado.";
    } else {
        $enviado = "Surgió un error en el envio: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <header>
        <nav class="nav-bar">
            <ul>
                <li><a href="../index.php">Inicio</a></li> 
                <li><a href="discografia.php">Discografia</a></li> 
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <div class="background"></div>
    
    <form class="form" method="post" action="contacto.php">
        <?php if ($enviado) {
            echo "<p class='form-success'>$enviado</p>";
            }
        ?>
        <h2 class="form-title">contacto</h2>
        <p>Para cualquier sugerencia o consulta, no dudes en escribirme:</p>
        <input class="form-input" type="email" name="email" placeholder="email*" required>    
        <input class="form-input" type="text" name="fname" placeholder="nombre">
        <input class="form-input" type="text" name="lname" placeholder="apellido">
        <input class="form-input" type="text" name="phone" placeholder="telefono">
        <input class="form-input" type="text" name="address" placeholder="direccion">
        <input class="form-input" type="text" name="city" placeholder="ciudad">
        <input class="form-input" type="text" name="country" placeholder="pais">
        <select class="form-input" name="falbum">
            <option value="" disabled selected>álbum favorito</option>
            <option value="Adrenaline">Adrenaline</option>
            <option value="Around the Fur">Around the Fur</option>
            <option value="White Pony">White Pony</option>
            <option value="Deftones">Deftones</option>
            <option value="Saturday Night Wrist">Saturday Night Wrist</option>
            <option value="Diamond Eyes">Diamond Eyes</option>
            <option value="Koi No Yokan">Koi No Yokan</option>
            <option value="Gore">Gore</option>
            <option value="Ohms">Ohms</option>
            <option value="Private Music">Private Music</option>
        </select>
        <textarea class="form-input" name="mensaje" placeholder="escribí tu mensaje aqui...*" required></textarea>
        <p>* campos obligatorios.</p>
        <input class="form-input" type="submit" value="enviar">
    </form>
</body>
</html>