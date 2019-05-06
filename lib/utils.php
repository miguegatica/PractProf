<?php





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










//<? php 
//https://translate.google.com/translate?hl=es&sl=en&u=https://gist.github.com/james2doyle/33794328675a6c88edd6&prev=search

//  función json_response ( $ mensaje = nulo , $ código = 200 ) 
//  { 
//  // borrar los encabezados antiguos 
//  header_remove (); 
//  // establece el código real 
//  http_response_code ( $ code ); 
//  // establece el encabezado para asegurarse de que el caché está forzado 
//  encabezado ( " Cache-Control: no-transform, public, max-age = 300, s-maxage = 900 " ); 
//  // trata esto como json 
//  encabezado ( ' Content-Type: application / json ' ); 
//  $ status = array ( 
//  200 => ' 200 OK ' , 
//  400 => ' 400 Bad Request ' , 
//  422 => ' Entidad no procesable ' , 
//  500 => ' 500 Error interno del servidor ' 
//  ); 
//  // ok, error de validación, o falla 
//  encabezado ( ' Estado: ' . $ estado [ $ código ]); 
//  // devuelve el json codificado 
//  devolver json_encode ( array ( 
//  ' estado ' => $ código < 300 , // éxito o no? 
//  ' mensaje ' => $ mensaje 
//  )); 
//  } 
//  // si estas haciendo ajax con encabezados de application-json 
//  if ( vacío ( $ _POST )) { 
// $ _POST = json_decode ( file_get_contents ( " php: // input " ), true )?  : []; 
//  } 
//  // uso 
//  echo json_response ( 200 , ' trabajo ' );  // {"estado": verdadero, "mensaje": "trabajando"} 
//  // uso de la matriz 
//  echo json_response ( 200 , array ( 
//  ' data ' => array ( 1 , 2 , 3 ) 
//  )); 
//  // {"estado": verdadero, "mensaje": {"datos": [1,2,3]}} 
//  // uso con error 
//  echo json_response ( 500 , ' ¡Error del servidor! ¡Inténtelo de nuevo! ' );  // {"estado": falso, "mensaje": "¡Error del servidor! ¡Inténtelo de nuevo!"} 
