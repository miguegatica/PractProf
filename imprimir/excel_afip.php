<?php

include_once(dirname(__FILE__).'/../login/loginok.php');

header("Pragma: public");
header("Expires: 0");
$filename = "SiGeUsuv2-PDV Export-.xls";
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
                    <th style="width: 40%;">nro_afipOld</th>
                    <th style="width: 25%;">Usuario</th>
                    <th style="width: 30%;">Rol</th>
                    <th style="width: 15%;">Activo</th>
                </tr>
                <?php foreach ($result as $User) { ?>
                    <tr>
                        <td><?php echo $User['nro_afipOld'];?></td>
                        <td><?php echo $User['descripcionOld'];?></td>
                        <td><?php echo $User['role'];?></td>
                        <td><?php echo $User['active'];?></td>
                    </tr>
                <?php } ?>

            </table>      

      
         
   
    </body>
</html>


