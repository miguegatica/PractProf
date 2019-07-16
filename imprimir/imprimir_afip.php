<?php

include_once(dirname(__FILE__).'/../login/loginok.php');



$dbname = $_SESSION['empresa.db']; 


$conexion = new PDO('mysql:host=localhost;dbname='.$dbname,'root','');

$conexion = new PDO('mysql:host=localhost;dbname='.$dbname,'root','');
 
$result=$conexion->query("SELECT * from afipauditoria");


?>


<!DOCTYPE html>
<html>
    <body onload="window.print();window.close();">
        <table>
                <tr>
                    <th style="width: 40%;">id</th>
                    <th style="width: 40%;">fecha</th>
                    <th style="width: 40%;">usuario</th>
                    <th style="width: 40%;">accion</th>
                    <th style="width: 40%;">hora</th>
                    <th style="width: 40%;">nro_afip</th>
                    <th style="width: 40%;">descripcion</th>
                    <th style="width: 40%;">sigla</th>
      
        
                    
                </tr>
                <?php foreach ($result as $User) { ?>
                <tr>
                <td><?php echo $User['id'];?></td>
                <td><?php echo $User['fecha'];?></td>
                <td><?php echo $User['usuario'];?></td>
                <td><?php echo $User['accion'];?></td>
                <td><?php echo $User['hora'];?></td>
                <td><?php echo $User['nro_afip'];?></td>
                <td><?php echo $User['descripcion'];?></td>
                <td><?php echo $User['sigla'];?></td>
                   
                </tr>
                <?php } ?>

        </table>      

      
         
   
    </body>
</html>


