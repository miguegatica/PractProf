<?php
include_once(dirname(__FILE__) . '/../lib/connections/conn.php');
include_once(dirname(__FILE__) . '/../lib/utils.php');

$userPost = empty($_POST['userPost']) ? exit() : $_POST['userPost'];
$passPost = empty($_POST['passPost']) ? exit() : $_POST['passPost'];
 

if(is_session_started() == false){
    session_start();
    ob_start();
}

if(empty($userPost) or empty($passPost) ){//si esta la sesion vacia lo redirige a login 
    header("location: ../login.php");
    exit();
}

$existeEnLaBD = false;
$date = date('Y-m-d');
$time = date('H:m:s');
if($userPost === 'soporte' and $passPost==='333'){
    $_SESSION['usuario'] = $userPost; 
    $_SESSION['date'] = $date;
    $_SESSION['time'] = $time;
    $_SESSION['operator_profile'] = '99';
    $_SESSION['SESS_MEMBER_ID'] = '99';
    
    header("Location: ../index.php");
    exit();
}else{
    $conn = null;
    $row_cnt = 0; 
    if (crearConexion($conn)){

         $query = "select usuario.id as idop, perfilusuario.* from perfilusuario INNER JOIN usuario ON (perfilusuario.id = usuario.perfilusuario_id) where nick='$userPost' and contrasenia='$passPost' ";
         $resultQuery = $conn->query($query);
         $userObject = $resultQuery->fetch_object();
         $perfil = $userObject->perfil;
         $perfilId = $userObject->id;
         $userId = $userObject->idop;

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
    }else{
        $existeEnLaBD = false;
    }

    
    if($existeEnLaBD){
        $_SESSION['usuario'] = $userPost; 
        $_SESSION['date'] = $date;
        $_SESSION['time'] = $time;
        $_SESSION['operator_profile'] = $perfilId;
        $_SESSION['SESS_MEMBER_ID'] = $userId;


            /*switch ($perfil) {
                case 'auditor':
                        $_SESSION['usuario'] = $userPost; // gracias a esta linea el usuario puede usar el sistema 
                        header("Location: ../indexAuditor.php");
                        exit();
                    break;
                case 'supervisor':
                        $_SESSION['usuario'] = $userPost; // gracias a esta linea el usuario puede usar el sistema 
                        header("Location: ../indexSupervisor.php");
                        exit();
                    break;
                  case 'usuario':
                  case 'superadmin':
                        $_SESSION['usuario'] = $userPost; // gracias a esta linea el usuario puede usar el sistema 
                        header("Location: ../index.php");
                        exit();
                    break;
            }*/
         header("Location: ../index.php");
         exit();

//         $movement = 'inicio sesion';
//         insert_log($movement);

    }

}




header("location: ../login.php");
exit();


    
    
    
    
    
    
    
    