<?php



include '../../modelo/ConectBe.php';

$correo = $_GET['correo'];

echo'$correo';
$resultado = mysqli_query($conexion, "DELETE FROM usuario WHERE correo = '$correo'");

header("Location: ../../vistas/dashboardAdmin.php");
?>