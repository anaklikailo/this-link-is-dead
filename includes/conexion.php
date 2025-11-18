<?php
function conectar()
{
	global $con;
	$con = mysqli_connect("localhost","root","","thislinkisdead");
		if (mysqli_connect_errno()) 
		{
		    printf("Falló la conexión: %s\n", mysqli_connect_error());
		    exit();
		}
}

function desconectar()
{
	global $con;
	mysqli_close($con);
}
?>