<?php


require('../lib_pdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de p�gina
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(60);
        // T�tulo
        $this->Ln(10);
        $this->Cell(60);
        $this->Cell(120,10,'LISTADO DE PDV - SiGeUsu v2',1,0,'C');
        // Salto de l�nea
        $this->Cell(60);
        #$this->Cell(120,10,'FECHA: '.date('d/m/Y'),1,0,'C');
        #$this->Cell(120,10,'HORA: '.date('H:m:s'),1,0,'C');
        $this->Ln(20);


    }

    // Pie de p�gina
    function Footer()
    {
        // Posici�n: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
    }

    // Una tabla
    function Tabla()
    {
        // Anchuras de las columnas
        $w = array(20, 35, 25, 10, 43, 150);
        // Cabeceras
        $this->Cell($w[2],7,'ID',1,0,'C');
        $this->Cell($w[5],7,'Descripcion',1,0,'C');
        $this->Ln();
        // Datos
        $conexion = new PDO('mysql:host=localhost;dbname=proyectopp1','root','');
        $data=$conexion->query("SELECT * from auditoriatipodocumento");
        foreach($data as $row)
         {
        $this->Cell($w[2],6,$row['nro_afipOld'],'LR');
        $this->Cell($w[5],6,$row['descripcionOld'],'LR');
        $this->Ln();
         }
        // L�nea de cierre
        $this->Cell(175,0,'','T');
}
}

// Creaci�n del objeto de la clase heredada
$pdf= new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(130);
$pdf->Cell(0,10,'FECHA:'.date('d/m/Y'),0,1);
$pdf->Cell(130);
$pdf->Cell(0,10,'HORA: '.date('H:m:s'),0,1);
$pdf->Tabla();
$pdf->Output();
?><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

