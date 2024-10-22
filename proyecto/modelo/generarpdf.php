<?php
require('../vista/fpdf.php');
include 'conexion.php'; 

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Lista de Reservas Registradas',0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'ID Reserva',1);
$pdf->Cell(30,10,'Fecha',1);
$pdf->Cell(30,10,'Hora Inicio',1);
$pdf->Cell(30,10,'Hora Fin',1);
$pdf->Cell(40,10,'Estado',1);
$pdf->Cell(40,10,'Sala',1);
$pdf->Ln();
$query = "SELECT idr, fecha, hora_inicio, hora_fin, estado, sala FROM reserva";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(20,10,$row['idr'],1);
        $pdf->Cell(30,10,$row['fecha'],1);
        $pdf->Cell(30,10,$row['hora_inicio'],1);
        $pdf->Cell(30,10,$row['hora_fin'],1);
        $pdf->Cell(40,10,$row['estado'],1);
        $pdf->Cell(40,10,$row['sala'],1);
        $pdf->Ln();
    }
}

$pdf->Output('D', 'Reservas.pdf'); 
?>
