<?php
include_once(dirname(__FILE__).'/../lib/utils.php');

include_once '../lib/connections/conn.php';

include_once '../lib/utils.php'; 


date_default_timezone_set('America/Argentina/Buenos_Aires');
$date=date("Y-m-d");
$time=date("H:i:s");


$userPost = empty($_POST['userPost']) ? exit() : $_POST['userPost'];
$passPost = empty($_POST['passPost']) ? exit() : $_POST['passPost'];
 

if(is_session_started() == false){
    session_start();
    ob_start();
}

if(empty($_POST['userPost']) or empty($_POST['passPost']) ){//si esta la sesion vacia lo redirige a login 
    header("location: ../login.php");
    exit();
}


$conn = null;
$row_cnt = 0; 
if (crearConexion($conn)){
    
     $query = "Select perfil from perfilusuario INNER JOIN usuario ON (perfilusuario.id = usuario.perfilusuario_id) where nick='$userPost' and contrasenia='$passPost' ";
     $resultQuery = $conn->query($query);
     $perfil = $resultQuery->fetch_object()->perfil;

     if(!$resultQuery){ 
           exit(json_response($conn->errno,422));
          
      }
     else {
     
        $row_cnt = $resultQuery->num_rows;  
        
        
        
     }
     
    $resultQuery->close();  
    $conn->close();
}     


    if ($row_cnt>0){
     $existeEnLaBD = true;
    }
     else {
        $existeEnLaBD = false;
    }


if($existeEnLaBD){
   
    switch ($perfil) {
        case 'auditor':
                $_SESSION['usuario'] = $userPost; // gracias a esta linea el usuario puede usar el sistema 
                $_SESSION['date'] = $date;
                $_SESSION['time'] = $time;
            
                
                header("Location: ../indexAuditor.php");
                exit();
            break;
        case 'supervisor':
                $_SESSION['usuario'] = $userPost; // gracias a esta linea el usuario puede usar el sistema 
                header("Location: ../indexSupervisor.php");
                exit();
            break;
          case 'usuario':
                $_SESSION['usuario'] = $userPost; // gracias a esta linea el usuario puede usar el sistema 
                header("Location: ../index.php");
                exit();
            break;
    }
    
    
}
header("location: ../login.php");
exit();


    
    
    
    
    
    
    
    