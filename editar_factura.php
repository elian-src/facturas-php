<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM factura WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    $factura = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $itebis = $_POST['itebis'];
    $descuento = $_POST['descuento'];

    $subtotal = $cantidad * $precio_unitario;
    $total_con_itebis = $subtotal + ($subtotal * ($itebis / 100));
    $total_general = $total_con_itebis - ($total_con_itebis * ($descuento / 100));

    $sql = "UPDATE factura SET 
            DESCRIPCION='$descripcion',
            CATEGORIA='$categoria',
            CANTIDAD=$cantidad,
            PRECIO_UNITARIO=$precio_unitario,
            ITEBIS=$itebis,
            DESCUENTO=$descuento,
            TOTAL_GENERAL=$total_general
            WHERE ID=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Factura actualizada exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Factura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <fieldset>
            <legend>Editar Factura</legend>
            <input type="hidden" name="id" value="<?php echo $factura['ID']; ?>">
            Descripción: <input type="text" name="descripcion" value="<?php echo $factura['DESCRIPCION']; ?>"><br>
            Categoría: <input type="text" name="categoria" value="<?php echo $factura['CATEGORIA']; ?>"><br>
            Cantidad: <input type="number" name="cantidad" value="<?php echo $factura['CANTIDAD']; ?>"><br>
            Precio Unitario: <input type="number" name="precio_unitario" value="<?php echo $factura['PRECIO_UNITARIO']; ?>"><br>
            ITEBIS (%): <input type="number" name="itebis" value="<?php echo $factura['ITEBIS']; ?>"><br>
            Descuento (%): <input type="number" name="descuento" value="<?php echo $factura['DESCUENTO']; ?>"><br>
            <input type="submit" value="Actualizar Factura">
        </fieldset>
    </form>
    <a href="index.html" class="btn-volver">Volver al Menú Principal</a>
</body>
</html>
