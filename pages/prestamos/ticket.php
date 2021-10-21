<?php
// Cargamos el código necesario para manejar la tabla de libros en la base de datos
require_once(__DIR__ . "/../libros/model/db.php");
// Cargamos el código necesario para manejar la tabla de socios en la base de datos.
require_once(__DIR__ . "/../socios/model/db.php");
// Cargamos el código necesario para manejar la tabla pedidos en la base de datos.
require_once(__DIR__ . "/model/db.php");

require_once(__DIR__ . "/../pdf/PDF.php");

$idPrestamo = $_REQUEST['idPrestamo'];
$prestamo = prestamosBuscarUno($idPrestamo);

$idSocio = $prestamo['idSocio'];
$idLibro = $prestamo['idLibro'];

$socio = sociosBuscarUno($idSocio);
$libro = librosBuscarUno($idLibro);

$usuario = iconv('UTF-8', 'windows-1252', $socio['nombre'] . " " . $socio['apellidos']);;
$libroPrestado = iconv('UTF-8', 'windows-1252', $libro['titulo']);
$fechaDevolucion = (string)$prestamo['fechaDevolucion'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Cell(10);
$pdf->Cell(55, 10, "USUARIO:", 0, 0);
$pdf->Cell(0, 10, $usuario, 0, 1);
$pdf->Cell(10);
$pdf->Cell(55, 10, "LIBRO PRESTADO:", 0, 0);
$pdf->Cell(0, 10, $libroPrestado, 0, 1);
$pdf->Cell(10);
$pdf->Cell(55, 10, iconv('UTF-8', 'windows-1252', "FECHA DE DEVOLUCIÓN:"), 0, 0);
$pdf->Cell(0, 10, $fechaDevolucion, 0, 1);
$pdf->Footer();
$pdf->Output('D', 'ticket.pdf');