<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM factura WHERE ID = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Factura eliminada correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<link rel="stylesheet" href="style.css">
<a href="listar_facturas.php">Volver al reporte</a>
<a href="index.html" class="btn-volver">Volver al Menú Principal</a>
