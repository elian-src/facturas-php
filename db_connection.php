<?php
$host = 'localhost';
$dbname = 'BD_FacturacionPruebas';
$username = 'root'; 
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>