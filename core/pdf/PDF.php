<?php
require_once(__DIR__ . '/../fpdf/fpdf.php');

/**
 * Clase PDF
 * 
 * Genera un archivo PDF con el contenido indicado.
 */
class PDF extends FPDF
{
    // Cabecera de página
    public function Header()
    {
        $titulo = "Biblioteca de Laboris";
        // Logo
        //$this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(80, 10, iconv('UTF-8', 'windows-1252', "RESGUARDO DE PRÉSTAMO"), 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    public function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        //$this->Cell(0, 10, "BIBLIOTECA LABORIS", 0, 0);
    }
}