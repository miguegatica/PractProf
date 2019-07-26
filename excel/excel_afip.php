<?php

include_once(dirname(__FILE__).'/../login/loginok.php');

session_start(); 

$dbname = $_SESSION['empresa.db']; 

header("Pragma: public");
header("Expires: 0");
$filename = "AFIP-Auditoria.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

$conexion = new PDO('mysql:host=localhost;dbname='.$dbname,'root','');
 
$result=$conexion->query("SELECT * from afipauditoria");


?>


<!DOCTYPE html>
<html>
    <body onload="window.close();">
        <table>
                <tr>
                    <th style="width: 40%;">id</th>
                    <th style="width: 40%;">nro_afip</th>
                    <th style="width: 40%;">descripcion</th>
                    <th style="width: 40%;">sigla</th>
                    <th style="width: 40%;">usuario</th>
                    <th style="width: 40%;">accion</th>
                    <th style="width: 40%;">fecha</th>
                    <th style="width: 40%;">hora</th>
                </tr>
                <?php foreach ($result as $User) { ?>
                    <tr>
                        <td><?php echo $User['id'];?></td>
                        <td><?php echo $User['nro_afip'];?></td>
                        <td><?php echo $User['descripcion'];?></td>
                        <td><?php echo $User['sigla'];?></td>
                        <td><?php echo $User['usuario'];?></td>
                        <td><?php echo $User['accion'];?></td>
                        <td><?php echo $User['fecha'];?></td>
                        <td><?php echo $User['hora'];?></td>
                    </tr>
                <?php } ?>

            </table>      

      
         
   
    </body>
</html>


