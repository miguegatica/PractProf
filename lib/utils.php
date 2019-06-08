
<?php




function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}


function json_response($message = null, $code = 200)
{
    // clear the old headers  ----- borrar los encabezados antiguos 
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced ----- establece el encabezado para asegurarse de que el caché está forzado 
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json -------- trata esto como json 
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request', //Solicitud incorrecta
        422 => 'Unprocessable Entity',//Entidad no procesable
        500 => '500 Internal Server Error'//error de servidor interno
        );
    // ok, validation error, or failure -------- ok, error de validación, o falla 
    header('Status: '.$status[$code]);
    // return the encoded json   ----------- devuelve el json codificado 
    return json_encode(array(
        'status' => $code < 300, // si el error es menor a 300 va a ponerlo en "true" (no hubo un error http)
        'errorMsg' => $message   // ..., sino va a mostrar este mensaje 
        ));
}







function insert_log($movement){
    if(session_status() == PHP_SESSION_NONE){
        session_start(); 
//        ob_start();    
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $date=date("Y-m-d");
    $time=date("H:i:s");   
      
    $userPost = $_SESSION['usuario'];
    
    $ip = $_SERVER["REMOTE_ADDR"];

    $conn = null;
    if (crearConexion($conn)){
        $queryAuditor = "INSERT INTO probandoauditoria (user, date, time, movement) VALUES ('$userPost', '$date', '$time', '$movement')";
        $conn->query($queryAuditor);

         $conn->close();

    }
   
}
    
       