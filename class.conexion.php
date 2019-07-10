<?php

 Class Conexion {
      public function get_conexion(){
          $user = "root";
          $pass = "";
          $host = "Localhost";
          $db=$_SESSION['empresa.db']; 
          $conn = new PDO ("mysql:host=$host;dbname=$db",$user,$pass);  
          return $conn;
      }    
     
    }

    
?>