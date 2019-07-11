<?php

session_start();



$nombreEmpresa = $_SESSION['empresa.nombre']; 

$empresa_db = $_SESSION['empresa.db']; 

$contrasenia = $_POST['contrasenia'];




function EXPORT_DATABASE($host,$user,$pass,$name,$tables=false, $backup_name=false)
{ 
	set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
	$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
	$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
	foreach($target_tables as $table){
		if (empty($table)){ continue; } 
		$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row(); 
		$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
		for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
			while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
				if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
					$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
				//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
				if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
			}
		} $content .="\n\n\n";
	}
	$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
	$backup_name = $backup_name ? $backup_name : $name.'___('.date('H-i-s').'_'.date('d-m-Y').').sql';
	ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\""); 
	echo $content; exit;
}




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




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
        EXPORT_DATABASE("localhost", "root", "", $empresa_db);
        include './Connet.php';
        $day=date("d");
        $mont=date("m");
        $year=date("Y");
        $hora=date("H-i-s");
        $fecha=$day.'_'.$mont.'_'.$year;
        $DataBASE=$fecha."_(".$hora."_hrs).sql";
        $tables=array();
        $result=SGBD::sql('SHOW TABLES');
        if($result){
            while($row=mysqli_fetch_row($result)){
               $tables[] = $row[0];
            }
            $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";
            $sql.='CREATE DATABASE IF NOT EXISTS '.$BD.";\n\n";
            $sql.='USE '.$BD.";\n\n";;
            foreach($tables as $table){
                $result=SGBD::sql('SELECT * FROM '.$table);
                if($result){
                    $numFields=mysqli_num_fields($result);
                    $sql.='DROP TABLE IF EXISTS '.$table.';';
                    $row2=mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE '.$table));
                    $sql.="\n\n".$row2[1].";\n\n";
                    for ($i=0; $i < $numFields; $i++){
                        while($row=mysqli_fetch_row($result)){
                            $sql.='INSERT INTO '.$table.' VALUES(';
                            for($j=0; $j<$numFields; $j++){
                                $row[$j]=addslashes($row[$j]);
                                $row[$j]=str_replace("\n","\\n",$row[$j]);
                                if (isset($row[$j])){
                                    $sql .= '"'.$row[$j].'"' ;
                                }
                                else{
                                    $sql.= '""';
                                }
                                if ($j < ($numFields-1)){
                                    $sql .= ',';
                                }
                            }
                            $sql.= ");\n";
                        }
                    }
                    $sql.="\n\n\n";
                }else{
                    $error=1;
                }
            }
            if($error==1){
                echo 'Ocurrio un error inesperado al crear la copia de seguridad';
            }else{
                chmod(BACKUP_PATH, 0777);
                $sql.='SET FOREIGN_KEY_CHECKS=1;';
                $handle=fopen(BACKUP_PATH.$DataBASE,'w+');
                if(fwrite($handle, $sql)){
                    fclose($handle);

                    echo "<script>
                        alert('Copia de seguridad realizada con éxito');
                        window.location= '../php/index_backup.php'
                    </script>";
        //            header('Location: ../index.php');

                }else{
                    echo "<script>
                        alert('Ocurrio un error inesperado al crear la copia de seguridad');
                        window.location= '../php/index_backup.php'
                    </script>";
                }
            }
        }else{
             echo "<script>
                        alert('Ocurrio un error inesperado');
                        window.location= '../php/index_backup.php'
                    </script>";
        }
        mysqli_free_result($result);
        
    }
        

