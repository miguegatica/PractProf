<?php

?>

<!------------------------------------------DESDE ACA INTENTANDO YO---------------------------------------------------------->

<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../../estilos/estilos.css">
</head>

<body>
      <nav class="menu">
           <ul>
               <li class="item-r"><a href="../../login.php">Salir</a></li> 
           </ul>
      </nav>
        
 
        <form class="formulario" action="./backup.php" method="POST">
            <div class="contenedor">
                <div class="input-contenedor">
                    <i class="fas fa-key icon"></i>
                    <input type="text" placeholder="Contraseña" required name="contrasenia">
                </div>

                 <!--<input type="submit" class="button" value="Crear" name="crear">-->
                 <input type="submit" class="button" value="Realizar copia de seguridad"/>
                 <p>Para hacer backup, ingrese la contraseña que se le solicito al Crear Empresa.</p>
            </div>
        </form>
</body>
</html>