<?php

include_once(dirname(__FILE__).'/../login/loginok.php');

header("Pragma: public");
header("Expires: 0");
$filename = "AFIP-Auditoria.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

$conexion = new PDO('mysql:host=localhost;dbname=proyectopp1','root','');
 
$result=$conexion->query("SELECT * from auditoriatipodocumento");


?>


<!DOCTYPE html>
<html>
    <body onload="window.close();">
        <table>
                <tr>
                    <th style="width: 40%;">id</th>
                    <th style="width: 40%;">nro_afipOld</th>
                    <th style="width: 40%;">descripcionOld</th>
                    <th style="width: 40%;">siglaOld</th>
                    <th style="width: 40%;">nro_afipNew</th>
                    <th style="width: 40%;">descripcionNew</th>
                    <th style="width: 40%;">siglaNew</th>
                    <th style="width: 40%;">usuario</th>
                    <th style="width: 40%;">accion</th>
                    <th style="width: 40%;">modulo</th>
                    <th style="width: 40%;">fecha</th>
                    <th style="width: 40%;">hora</th>
                </tr>
                <?php foreach ($result as $User) { ?>
                    <tr>
                        <td><?php echo $User['id'];?></td>
                        <td><?php echo $User['nro_afipOld'];?></td>
                        <td><?php echo $User['descripcionOld'];?></td>
                        <td><?php echo $User['siglaOld'];?></td>
                        <td><?php echo $User['nro_afipNew'];?></td>
                        <td><?php echo $User['descripcionNew'];?></td>
                        <td><?php echo $User['siglaNew'];?></td>
                        <td><?php echo $User['usuario'];?></td>
                        <td><?php echo $User['accion'];?></td>
                        <td><?php echo $User['modulo'];?></td>
                        <td><?php echo $User['fecha'];?></td>
                        <td><?php echo $User['hora'];?></td>
                    </tr>
                <?php } ?>

            </table>      

      
         
   
    </body>
</html>


