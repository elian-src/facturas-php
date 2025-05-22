<?php
require('fpdf/fpdf.php');
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM factura WHERE ID = $id";
    $result = mysqli_query($conn, $sql);
    $factura = mysqli_fetch_assoc($result);

    if ($factura) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);

        // Encabezado
        $pdf->Cell(0,10,'Factura #'.$factura['ID'],0,1,'C');
        $pdf->Ln(10);

        // Detalles de la factura
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,'Descripcion:',0,0);
        $pdf->Cell(100,10,$factura['DESCRIPCION'],0,1);
        $pdf->Cell(50,10,'Categoria:',0,0);
        $pdf->Cell(100,10,$factura['CATEGORIA'],0,1);
        $pdf->Cell(50,10,'Cantidad:',0,0);
        $pdf->Cell(100,10,$factura['CANTIDAD'],0,1);
        $pdf->Cell(50,10,'Precio Unitario:',0,0);
        $pdf->Cell(100,10,'$'.number_format($factura['PRECIO_UNITARIO'], 2),0,1);
        $pdf->Cell(50,10,'ITEBIS (%):',0,0);
        $pdf->Cell(100,10,$factura['ITEBIS'].'%',0,1);
        $pdf->Cell(50,10,'Descuento (%):',0,0);
        $pdf->Cell(100,10,$factura['DESCUENTO'].'%',0,1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(50,10,'Total General:',0,0);
        $pdf->Cell(100,10,'$'.number_format($factura['TOTAL_GENERAL'], 2),0,1);

        // Pie de página
        $pdf->Ln(10);
        $pdf->SetFont('Arial','I',10);
        $pdf->Cell(0,10,'Gracias por su compra.',0,1,'C');

        $pdf->Output();
        exit;
    } else {
        echo "Factura no encontrada.";
    }
} else {
    echo "ID no proporcionado.";
}
?>
