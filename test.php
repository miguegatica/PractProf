<form method="POST" action="/test.php">
    Nombre <br>
    <input type="text" name="nombre">
    <br>
    Apellido <br>
    <input type="text" name="apellido">
    <br>
    <input type="submit" value="Submit">
</form>


<?php

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

print_r("Bienvenido! querido...".$nombre." ".$apellido);
