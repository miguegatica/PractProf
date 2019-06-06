<?php

include_once(dirname(__FILE__).'/../lib/utils.php');

$date=date("Y-m-d");
$time=date("H:i:s");


if(is_session_started() == false){
    //Si esta apagada la session la enscendemos
    session_start();
}


if(empty($_SESSION['usuario'])){ //si esta la sesion vacia lo redirige a login 
    header("location:login.php");
    exit();
}



/*

1)Empieza en el login, lo manda a acceso.php
2)En acceso.php se busca en la base de datos si existe el usuario, si existe lo manda al index`php  
3)En el index.php se hace un include (lo manda) a loginok.php
  El index.php piensa "si me estan llamando es porque tiene un loginok" 
4) En el loginok.php si no existe, lo manda directamente al formulario de login.php
5) En el login.php, el login lo vacia
 
   if(is_session_started() == false){
    session_start();
}

$_SESSION['usuario'] = ""; 



6) El botin salir lo manda directamente al login.php, porque el login.php directamente lo vacia 
*/








//En php existe un array que permite almacenar memoria entre un navegador y un servidor. Este array se llama session
//Es necesario enscenderlo para utilizarlo.

//PHP_SESSION_NONE es un constante de PHP, y a la vez es uno de los posibles resultados de la funcion session_status
//Ambas cosas vienen ya incluidas en las utilidades de PHP.

//¿Exisrte en el array de $_SESSION el campo usuario? 
//...ahora dandole miguel no esta vacio...

//$_SESSION['usuario'] = 'miguel';
// ES DECIR, esta funcion quiere saber si existe la variable usuario, sino te manda al login 








//La $_SESSION es un espacio en memoria que almacena el servidor entre el y el navegador que se este usando en ese momento! 
// el servidor con $_SESSION tiene memeoria, por ello se llaman "variables de estado", por que estan en constante 
// ...comunicacion con vos, como una linea telefonica que no se corta 
// LA COMUNICACION DEL CON LA MEMORIA DEL SERVIDOR ES COMUN AL NAVEGADOR, ejemplo las horas son diferentes en chrome con firefox

//Con $_SESSION , el servidor almacena temporalmente los datos 
// A $dste le doy los datos del sistema, al principio esta vacio, pero luego no entra mas a empty y muestra el dato constante

//$date = date('Y-d-m H:s');
//if(empty($_SESSION['date'])){ //si esta la sesion vacia lo redirige a login 
//    $_SESSION['date'] = $date; 
//}
//
//echo $_SESSION['date']; 

