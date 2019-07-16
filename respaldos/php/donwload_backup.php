<?php
session_start();

$idbackup= $_GET['id'];

//$nombreEmpresa = $_SESSION['empresa.nombre']; 

if (!empty($idbackup)){

        

        $path=dirname( __FILE__ ) . '/../clientes/'.$_SESSION['empresa.db']."/";
        
        print_r($path.$idbackup);
        
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($path.$idbackup));
        header('Content-Disposition: attachment; filename=' . basename($idbackup));
        readfile($path.$idbackup);
        
          
 
}



//_Download("../directory/to/tar/raj.tar", "raj.tar");

exit;

