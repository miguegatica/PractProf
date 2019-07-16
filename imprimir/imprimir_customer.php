<?php

include_once(dirname(__FILE__).'/../login/loginok.php');

//session_start(); 

$dbname = $_SESSION['empresa.db']; 


$conexion = new PDO('mysql:host=localhost;dbname='.$dbname,'root','');
 
$result=$conexion->query("select clienteauditoria.*, 
(select CONCAT(sigla,' (',nro_afip,')')  from tipodocumento where tipodocumento.id=clienteauditoria.tipodocumento_id) as tipodocumento_id, (select CONCAT(sigla,' (',nro_afip,')')  from tipodocumento where tipodocumento.id=clienteauditoria.tipodocumento_id) as tipodocumento_id
from clienteauditoria");


?>


<!DOCTYPE html>
<html>
    <body onload="window.print();window.close();">
        <table>
                <tr>
                   <th style="width: 40%;">id</th>
                    <th style="width: 40%;">num_cliente</th>
                    <th style="width: 40%;">apellido</th>
                    <th style="width: 40%;">nombre</th>
                    <th style="width: 40%;">nro_documento</th>
                    <th style="width: 40%;">tipodocumento</th>
                    <th style="width: 40%;">usuario</th>
                    <th style="width: 40%;">accion</th>
                    <th style="width: 40%;">fecha</th>
                    <th style="width: 40%;">hora</th>
                    
                </tr>
                <?php foreach ($result as $User) { ?>
                    <tr>
                        <td><?php echo $User['id'];?></td>
                        <td><?php echo $User['num_cliente'];?></td>
                        <td><?php echo $User['apellido'];?></td>
                        <td><?php echo $User['nombre'];?></td>
                        <td><?php echo $User['nro_documento'];?></td>
                        <td><?php echo $User['tipodocumento_id'];?></td>
                        <td><?php echo $User['usuario'];?></td>
                        <td><?php echo $User['accion'];?></td>
                        <td><?php echo $User['fecha'];?></td>
                        <td><?php echo $User['hora'];?></td>
                        
                    </tr>
                <?php } ?>

            </table>      

      
         
   
    </body>
</html>


