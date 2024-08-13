<?php

require "fpdf.php";

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {

      $this->Image('logo_sin_entrelazado.png', 9, 19, 100); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->Ln(6); // Salto de línea
      $this->SetFont('Arial', 'B', 30); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(125); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(130, 15, utf8_decode('UNIVERSIDAD TECNOLÓGICA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Cell(125); // Movernos a la derecha
      $this->Cell(130, 15, utf8_decode('DE LA SELVA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(8); // Salto de línea
      $this->SetTextColor(103); //color

      /* GENERADO 
      $this->Cell(8);  // mover a la derecha
      $this->SetFont('Arial', 'B', 14);
      $this->Cell(96, 10, utf8_decode("Generado por : " . $_SESSION['nombre']), 0, 0, '', 0);
      $this->Ln(15);*/

      /* CORREO */
      /*$this->Cell(8);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : "), 0, 0, '', 0);
      $this->Ln(5);*/

      /* TELEFONO */
      /*$this->Cell(8);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : "), 0, 0, '', 0);
      $this->Ln(20);*/

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(85); // mover a la derecha
      $this->SetFont('Arial', 'B', 18);
      $this->Cell(100, 10, utf8_decode("REPORTE DE DOCENTES"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      /*la suma del ancho de la tabla
         debe de dar 275*/
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(20, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(97, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
      $this->Cell(41, 10, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('LÍDER'), 1, 0, 'C', 1);
      $this->Cell(97, 10, utf8_decode('CORREO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//CADENA DE CONEXION
$con = mysqli_connect("localhost","root","","gestor");

$consulta = "SELECT id_docente, nombre, telefono, lider, correo, contrasena FROM docentes";
  
$result = mysqli_query($con,$consulta);

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/

while ($row = mysqli_fetch_array($result)) { 

$i = $i + 1;
/* TABLA */
$pdf->Cell(20, 10, utf8_decode($row[0]), 1, 0, 'C', 0);
$pdf->Cell(97, 10, utf8_decode($row[1]), 1, 0, 'C', 0);
$pdf->Cell(41, 10, utf8_decode($row[2]), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode($row[3]), 1, 0, 'C', 0);
$pdf->Cell(97, 10, utf8_decode($row[4]), 1, 1, 'C', 0);

$exec=mysqli_query($con,$consulta); 

}

mysqli_close($con);
  session_start();
  if(@$_SESSION['validada']==1)


$pdf->Output('Reporte Docentes.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
