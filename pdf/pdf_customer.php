<?php


require('../lib_pdf/fpdf.php');

session_start(); 


class PDF extends FPDF
{
    // Cabecera de p�gina
    function Header()
    {
        // Logo
       //Aca lo activan solo si tienen un logo, y cambian logo.png por el archivo de su logo -->  $this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(60);
        // T�tulo
        $this->Ln(10);
        $this->Cell(60);
        $this->Cell(120,10,'AUDITORIA CLIENTE',1,0,'C');
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
        
        $dbname = $_SESSION['empresa.db']; 
        // Anchuras de las columnas
        $w = array(20, 35, 25, 10, 43, 150);
        // Cabeceras
        $this->Cell($w[3],7,'id',1,0,'C');
        $this->Cell($w[0],7,'NumCliente',1,0,'C');
        $this->Cell($w[0],7,'Apellido',1,0,'C');
        $this->Cell($w[0],7,'Nombre',1,0,'C');
        $this->Cell($w[0],7,'NroDoc',1,0,'C');
        $this->Cell($w[0],7,'TipoDoc',1,0,'C');
        $this->Cell($w[0],7,'usuario',1,0,'C');
        $this->Cell($w[0],7,'accion',1,0,'C');
        $this->Cell($w[0],7,'fecha',1,0,'C');
        $this->Cell($w[0],7,'hora',1,0,'C');
        $this->Ln();
        // Datos
        $conexion = new PDO('mysql:host=localhost;dbname='.$dbname,'root','');
        $data=$conexion->query("select clienteauditoria.*, 
        (select CONCAT(sigla,' (',nro_afip,')')  from tipodocumento where tipodocumento.id=clienteauditoria.tipodocumento_id) as tipodocumento_id, (select CONCAT(sigla,' (',nro_afip,')')  from tipodocumento where tipodocumento.id=clienteauditoria.tipodocumento_id) as tipodocumento_id
        from clienteauditoria");
        foreach($data as $row)
         {
        $this->Cell($w[3],6,$row['id'],'LR');
        $this->Cell($w[0],6,$row['num_cliente'],'LR');
        $this->Cell($w[0],6,$row['apellido'],'LR');
        $this->Cell($w[0],6,$row['nombre'],'LR');
        $this->Cell($w[0],6,$row['nro_documento'],'LR');
        $this->Cell($w[0],6,$row['tipodocumento_id'],'LR');
        $this->Cell($w[0],6,$row['usuario'],'LR');
        $this->Cell($w[0],6,$row['accion'],'LR');
        $this->Cell($w[0],6,$row['fecha'],'LR');
        $this->Cell($w[0],6,$row['hora'],'LR');
        $this->Ln();
         }
     // L�nea de cierre
        $this->Cell(190,0,'','T');
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

