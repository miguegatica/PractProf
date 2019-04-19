<?php




include_once '../lib/connections/config.php';



/////////////////////////////// 1) ABRIR UNA CONEXION A LA BASE DE DATOS MYSQLI /////////////////////////////////////////////



//# El simbolo & es por referencia (se pasa la direccion en memoria donde esta guardada la variable)
//..., La palabra global permite usar variables que NO esten declaradas dentro de la funcion

 //#Con mysqli php logra conectarse a una base de datos, y con esta crea un objeto de conexion..con NEW

//#Mysql crea un objeto de conexion SI o SI, pero si contiene algo en su atributo connect_error, 
//...., significa que hubo un error en el intento.

//# Si falla el intento...en conn, en vez en de enviar el objeto de conexion, enviamos un string con el error.., Y devolvemos false

 //# Retornamos true...porque no hubo error en el intento



function crearConexion(&$conn){ 
    
    global $server,$user,$pass, $database, $port; //global, significa que salga afuera y busques estas variables 
   
    $conn = new mysqli($server,$user,$pass, $database, $port);
    
    if($conn->connect_error){ 
      
        $conn = 'Error en la conexion : '.$conn->connect_errno.'-'.$conn->connect_error;

        return false;
    }
   
    return true;
}


// ME VOY A tiposdoc_retrieve.php a CREAR LA CONEXION 