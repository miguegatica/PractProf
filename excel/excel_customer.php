<?php

include_once(dirname(__FILE__).'/../login/loginok.php');

header("Pragma: public");
header("Expires: 0");
$filename = "CUSTOMER-Auditoria.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

$conexion = new PDO('mysql:host=localhost;dbname=proyectopp1','root','');
 
$result=$conexion->query("SELECT * from clienteauditoria");


?>


<!DOCTYPE html>
<html>
    <body onload="window.close();">
        <table>
                <tr>
                    <th style="width: 40%;">id</th>
                    <th style="width: 40%;">num_clienteOld</th>
                    <th style="width: 40%;">apellidoOld</th>
                    <th style="width: 40%;">nombreOld</th>
                    <th style="width: 40%;">nro_documentoOld</th>
                    <th style="width: 40%;">tipodocumento_idOld</th>
                    <th style="width: 40%;">num_clienteNew</th>
                    <th style="width: 40%;">apellidoNew</th>
                    <th style="width: 40%;">nombreNew</th>
                    <th style="width: 40%;">nro_documentoNew</th>
                    <th style="width: 40%;">tipodocumento_idNew</th>
                    <th style="width: 40%;">usuario</th>
                    <th style="width: 40%;">accion</th>
                    <th style="width: 40%;">modulo</th>
                    <th style="width: 40%;">fecha</th>
                    <th style="width: 40%;">hora</th>
                </tr>
                <?php foreach ($result as $User) { ?>
                    <tr>
                        <td><?php echo $User['id'];?></td>
                        <td><?php echo $User['num_clienteOld'];?></td>
                        <td><?php echo $User['apellidoOld'];?></td>
                        <td><?php echo $User['nombreOld'];?></td>
                        <td><?php echo $User['nro_documentoOld'];?></td>
                        <td><?php echo $User['tipodocumento_idOld'];?></td>
                        <td><?php echo $User['num_clienteNew'];?></td>
                        <td><?php echo $User['apellidoNew'];?></td>
                        <td><?php echo $User['nombreNew'];?></td>
                        <td><?php echo $User['nro_documentoNew'];?></td>
                        <td><?php echo $User['tipodocumento_idNew'];?></td>
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


