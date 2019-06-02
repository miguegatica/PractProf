<?php

// CON  include_once '../lib/connections/config.php' dentro de tiposdoc_retrieve.php estamos llamando a estos datos


// Aca te tengo los datos que voy a pasar en el objeto creado de conexion $conn que fue pasado por referencia
// .., por lo que """ $conn = new mysqli($server,$user,$pass, $database, $port)""" le dare estas variables

//si hay un error de conexion ese objeto $conn, que le habiamos dado un objeto mysqli, le dareamos un string con msj de error


$server="127.0.0.1"; //es la IP
$user="root"; //es el que te pone xampp por defecto
$pass="";
$database="proyectopp1"; 
$port="3306"; //es el puerto virtual que viene por defecto  



//En sistemas operativos del tipo Unix, el superusuario o ROOT es el nombre convencional 
//de la cuenta de usuario que posee todos los derechos en todos los modos (monousuario o multiusuario).

