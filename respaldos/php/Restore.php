

<?php



session_start();

$nombreEmpresa = $_SESSION['empresa.nombre']; 

$nombreBD = $_SESSION['empresa.db'];
    
if (isset($_POST['restore'])){  


    $contrasenia = $_POST['contrasenia'];

    $company_backup = $_POST['company_backup'];



    //SI contrasenia es igual a la que tiene la empresa en SESSION ....

        $conn = new PDO ('mysql:host=localhost;dbname=sistemas_3','root','');

        $statement = $conn->prepare('SELECT count(*) FROM empresas WHERE (nombre =:nombre) and (contrasenia=:contrasenia) ');
        $statement->bindParam(':nombre', $nombreEmpresa);
        $statement->bindParam(':contrasenia', $contrasenia);
        $statement->execute();

        $result = $statement->fetch(); 

        $count = $result[0];


        if ($count == 0){
            echo "<script>
                            alert('Contraseña no válida. Verifique su contraseña.');
                            window.location= '../php/index_backup.php'
                        </script>";
        }else{

        $companyname=$_SESSION['empresa.nombre'];
        $bd_name=trim($companyname);
        $bd_name=str_replace(' ','',$bd_name);
        $bd_name=str_replace('/','',$bd_name);
        $bd_name=str_replace('.','',$bd_name);
        $fileTmpPath = $_FILES[$company_backup]['tmp_name'];
        $fileName = $_FILES[$company_backup]['name'];
        $fileSize = $_FILES[$company_backup]['size'];
        $fileType = $_FILES[$company_backup]['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = $bd_name . '.' . $fileExtension;
        $uploadFileDir = '../miguel/respaldos/';
        $dest_path = $uploadFileDir . $newFileName;
        move_uploaded_file($fileTmpPath, $dest_path);    

        $SQL_CONTENT = (strlen($dest_path) > 300 ?  $dest_path : file_get_contents($dest_path) );  

        if(is_int(strpos($SQL_CONTENT,$_SESSION['empresa.db']))){    

            //elimino todas mis tablas

            $DeleteTable=$conexion->query("DROP TABLE afipauditoria");
            $DeleteTable=$conexion->query("DROP TABLE cliente");
            $DeleteTable=$conexion->query("DROP TABLE clienteauditoria");
            $DeleteTable=$conexion->query("DROP TABLE migrations");
            $DeleteTable=$conexion->query("DROP TABLE params");
            $DeleteTable=$conexion->query("DROP TABLE perfilusuario");
            $DeleteTable=$conexion->query("DROP TABLE permisos");
            $DeleteTable=$conexion->query("DROP TABLE permisos_perfiles");
            $DeleteTable=$conexion->query("DROP TABLE tipodocumento");
            $DeleteTable=$conexion->query("DROP TABLE usuario");

            IMPORT_TABLES("localhost", "root", "",$nombreBD, $dest_path); //LLAMO A LA FUNCION 
    

   
          } 
        }        

     }
        

        
//    include './Connet.php';
//
//    $restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
//    $sql=explode(";",file_get_contents($restorePoint));
//    $totalErrors=0;
//    set_time_limit (60);
//    $con=mysqli_connect(SERVER, USER, PASS, $nombreBD);
//    $con->query("SET FOREIGN_KEY_CHECKS=0");
//    for($i = 0; $i < (count($sql)-1); $i++){
//        if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
//    }
//    $con->query("SET FOREIGN_KEY_CHECKS=1");
//    $con->close();
//    if($totalErrors<=0){
//            echo "<script>
//                    alert('Restauración completada con éxito!');
//                    window.location= '../php/index_restore.php'
//                </script>";
//}else{
//	echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
//}
//
//        
// }

 
 
 
 
 
 
 
 
 
 
 
//        if(isset($_POST['restore2'])){

//    $companyname=$_SESSION['empresa.nombre'];
//    $bd_name=trim($companyname);
//    $bd_name=str_replace(' ','',$bd_name);
//    $bd_name=str_replace('/','',$bd_name);
//    $bd_name=str_replace('.','',$bd_name);
//    $fileTmpPath = $_FILES[$company_backup]['tmp_name'];
//    $fileName = $_FILES[$company_backup]['name'];
//    $fileSize = $_FILES[$company_backup]['size'];
//    $fileType = $_FILES[$company_backup]['type'];
//    $fileNameCmps = explode(".", $fileName);
//    $fileExtension = strtolower(end($fileNameCmps));
//    $newFileName = $bd_name . '.' . $fileExtension;
//    $uploadFileDir = '../miguel/respaldos/';
//    $dest_path = $uploadFileDir . $newFileName;
//    move_uploaded_file($fileTmpPath, $dest_path);    
//
//    $SQL_CONTENT = (strlen($dest_path) > 300 ?  $dest_path : file_get_contents($dest_path) );  
//
//    if(is_int(strpos($SQL_CONTENT,$_SESSION['empresa.db']))){    
//
//        //elimino todas mis tablas
//
//        $DeleteTable=$conexion->query("DROP TABLE afipauditoria");
//        $DeleteTable=$conexion->query("DROP TABLE cliente");
//        $DeleteTable=$conexion->query("DROP TABLE clienteauditoria");
//        $DeleteTable=$conexion->query("DROP TABLE migrations");
//        $DeleteTable=$conexion->query("DROP TABLE params");
//        $DeleteTable=$conexion->query("DROP TABLE perfilusuario");
//        $DeleteTable=$conexion->query("DROP TABLE permisos");
//        $DeleteTable=$conexion->query("DROP TABLE permisos_perfiles");
//        $DeleteTable=$conexion->query("DROP TABLE tipodocumento");
//        $DeleteTable=$conexion->query("DROP TABLE usuario");
//
//        IMPORT_TABLES("localhost", "root", "",$nombreBD, $dest_path); //LLAMO A LA FUNCION 
//
////      header ("Location: empresas.php");
//
//        echo "<script language='JavaScript'>alert('COPIA DE SEGURIDAD RESTAURADA CON EXITO');</script>"; 
//
//
//    }else{
//        echo "<script language='JavaScript'>alert('No se puede restaurar esta copia de seguridad debido a que no corresponde a esta empresa...');</script>"; 
//    } 
//        
//        
        
// }
 
 




















