<?php
include('db_connection.php');

$sql = "SELECT * FROM factura";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Facturas</title>
    <link rel="stylesheet" href="style.css">    
</head>
<body>
    <h2>Reporte de Facturas</h2>
    <?php 
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>ITEBIS (%)</th>
                        <th>Descuento (%)</th>
                        <th>Total General</th>
                        <th>Acciones</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["ID"];
                echo "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['DESCRIPCION']}</td>
                        <td>{$row['CATEGORIA']}</td>
                        <td>{$row['CANTIDAD']}</td>
                        <td>{$row['PRECIO_UNITARIO']}</td>
                        <td>{$row['ITEBIS']}</td>
                        <td>{$row['DESCUENTO']}</td>
                        <td>{$row['TOTAL_GENERAL']}</td>
                        <td>
                            <a href='editar_factura.php?id=$id'>Editar</a> |
                            <a href='eliminar_factura.php?id=$id' onclick=\"return confirm('¿Eliminar esta factura?');\">Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay facturas registradas.";
        }
    ?>
    <a href="index.html" class="btn-volver">Volver al Menú Principal</a>
</body>
</html>
