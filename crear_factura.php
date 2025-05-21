<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $itebis = $_POST['itebis'];
    $descuento = $_POST['descuento'];

    $subtotal = $cantidad * $precio_unitario;
    $total_con_itebis = $subtotal + ($subtotal * ($itebis / 100));
    $total_general = $total_con_itebis - ($total_con_itebis * ($descuento / 100));

    $sql = "INSERT INTO factura (DESCRIPCION, CATEGORIA, CANTIDAD, PRECIO_UNITARIO, ITEBIS, DESCUENTO, TOTAL_GENERAL)
            VALUES ('$descripcion', '$categoria', $cantidad, $precio_unitario, $itebis, $descuento, $total_general)";

    if (mysqli_query($conn, $sql)) {
        echo "Factura registrada exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Factura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <fieldset>
            <legend>Registro de Factura</legend>
            Descripción: <input type="text" name="descripcion" required><br>
            Categoría: <input type="text" name="categoria" required><br>
            Cantidad: <input type="number" name="cantidad" required><br>
            Precio Unitario: <input type="number" step="0.01" name="precio_unitario" required><br>
            ITEBIS (%): <input type="number" step="0.01" name="itebis" required><br>
            Descuento (%): <input type="number" step="0.01" name="descuento" required><br>
            <input type="submit" value="Registrar Factura">
        </fieldset>
    </form>
    <a href="index.html" class="btn-volver">Volver al Menú Principal</a>
</body>
</html>
