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

    
	<form class="formulario" action="./restore.php" method="POST">
            
                <div class="contenedor">
                    <div class="input-contenedor">
                        <i class="fas fa-key icon"></i>
                        <input type="text" placeholder="Contraseña" required name="contrasenia">
                    </div>
                    <select class="contenedor" name="restorePoint">
			<option value="" disabled="" selected="">Seleccionar punto de restauración</option>
			<?php
				include_once './Connet.php';
				$ruta=BACKUP_PATH."/".$_SESSION['empresa.db'];
				if(is_dir($ruta)){
				    if($aux=opendir($ruta)){
				        while(($archivo = readdir($aux)) !== false){
				            if($archivo!="."&&$archivo!=".."){
				                //$nombrearchivo=str_replace(".sql", "", $archivo);
				                //$nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                $ruta_completa=$ruta.$archivo;
				                if(is_dir($ruta_completa)){
				                }else{
				                    echo '<option value="'.$ruta_completa.'">'.$archivo.'</option>';
				                }
				            }
				        }
				        closedir($aux);
				    }
				}else{
				    echo $ruta." No es ruta válida";
				}
			?>
                    </select>
               </div>
	        <button class="button" type="submit" >Restaurar</button>
                <p>Para llevar a cabo la restauración, ingrese la contraseña que se le solicito al Crear Empresa.</p>
           
               
	</form>
</body>
</html>













<!--    <html lang="es">
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


            <form class="formulario" action="./restore.php" method="POST">

                    <div class="contenedor">
                        <div class="input-contenedor">
                            <i class="fas fa-key icon"></i>
                            <input type="text" placeholder="Contraseña" required name="contrasenia">
                        </div>

                             <br> <input style="margin-left:110px;" type="file" accept=".sql"  name="company_backup" id="company_backup" class="form-input">

                   </div>
                    <button class="button" type="submit" >Restaurar</button>
                    <p>Para llevar a cabo la restauración, ingrese la contraseña que se le solicito al Crear Empresa.</p>


            </form>
    </body>
    </html>-->




