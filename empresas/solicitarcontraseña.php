<?php

session_start(); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


//recibir nombre del usuario logueado, o nombre de la persona que solicito contraseña

if(isset($_POST['enviar'])){
    
    $name = $_POST['name'];
    $correo = $_POST['correo'];
    
 //insertar esta contrasenia en la base de datos 'claves' en la tabla 'claves' 
 //crear la tabla 'informacion' dentro de cada base de datos con los campos:
        //*nombre
        //*bd
        //*CUIT
        //*Sit IVA
        //*Domicilio 
 
 //Luego comparar la contrasenia que ingresa con la bbdd 'clave' en la talba 'clave' 
    
    $contrasenia = mt_rand(3333,9999);
    $uso = 'true';
    
    
//     $insertarempresa = $conn->prepare('INSERT INTO empresas (nombre, bd, contrasenia) VALUES (:nombre, :bd, :contrasenia) ');
//        $insertarempresa->bindParam(':nombre', $companyname);
//        $insertarempresa->bindParam(':bd', $bd_name);
//        $insertarempresa->bindParam(':contrasenia', $contrasenia);
//        $insertarempresa->execute();
//    
    
    $conn = new PDO ('mysql:host=localhost;dbname=claves','root','');
    $insertPassword = $conn->prepare('INSERT INTO claves (contrasenia, uso) VALUES (:contrasenia, :uso) ');
    $insertPassword->bindParam(':contrasenia', $contrasenia);
    $insertPassword->bindParam(':uso', $uso);
    $insertPassword->execute(); 
      
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'SWGatCal@gmail.com';                     // SMTP username
        $mail->Password   = 'unodostres';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('SWGatCal@gmail.com', 'SW GaticaCalamante');
        $mail->addAddress($correo, 'Receptor Joe User');  
//        $mail->addAddress('miguel.elias.gatica2019@gmail.com', 'Receptor Joe User');  


        // Attachments
    //    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Respuesta a la solicitud de contrasenia';
        $mail->Body    = 'Estimado '.$name.', en respuesta a la solicitud de clave para Crear Empresa, ingrese esta clave única: '.$contrasenia.' . Proteja esta contraseña, con la misma podrá realizar copias de seguridad y restauración. Si desea crear otra empresa, volver a solicitar una nueva clave';

//        aca podria dejarle el enlace para que valla directamente a ingresar la contraseña
        
        
        $mail->send();
        echo '<script>alert("La contraseña ha sida enviada. Revise su gmail");</script>';
 
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
    
      
}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="../estilos/estilos.css">
        
</head>  
<body class="mainBody">
    
    <div id="header">
               <ul class="nav">
                    <li><a href="../empresas/empresas.php">Volver a Empresas</a></li> 
                </ul>
    </div>    
    
 <form class="formulario" action="solicitarcontraseña.php" method="POST">
    <h1>Solicitar contraseña</h1> 
     
    <div class="contenedor">

        <div class="input-contenedor">
            <i class="fas fa-building icon"></i>
            <input type="text" placeholder="Nombre" required name="name">
        </div>
        <div class="input-contenedor">
            <i class="fas fa-envelope icon"></i>
            <input type="text" placeholder="Correo electrónico" required name="correo">
        </div>

         <input type="submit" class="button" value="Enviar" name="enviar">
         <p>¿Ya tienes contraseña?<a class="referencia" href="nuevaempresa.php"> Crear Empresa</a></p>
    </div>

 </form>
</body>

</html>



















