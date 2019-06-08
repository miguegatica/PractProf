<?php

include_once(dirname(__FILE__).'/../login/loginok.php');



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


