<?php 


include_once(dirname(__FILE__).'/lib/utils.php');

if(is_session_started() == false){
    //Si esta apagada la session la enscendemos
    session_start();
    ob_start();
}


$_SESSION['usuario'] = ""; 


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema Práctica Profesional</title>
        
<!--        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/demo/demo.css">-->

        <script type="text/javascript" src="lib/jquery/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery.edatagrid.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="estilos/estilos.css">
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
   
    </head>

    <body class="mainBody">
    <header>
        
        <div class="logoContorno">
            <div class="logo">
                <div class="nombreEmpresa">
                    <?php echo 'Empresa '.'"'.$_SESSION['empresa.nombre'].'"';?>
                    
                </div>
            </div>
        </div>
        
        
        <div id="header">
            <ul class="nav">
                     <li><a class="a" href="respaldos/php/index_backup.php">Backup</a></li>
                     <li><a class="a" href="respaldos/php/index_restore.php">Restaurar</a></li>
                     <li><a class="a" href="empresas/empresas.php">Volver a Empresas</a></li> 
            </ul>
        </div>


    </header>   
       
       
       
   
   <form action="login/acceso.php" method="post" class="formulario">
    <h1>Iniciar sesión</h1> 
     
    <div class="contenedor">

        <div class="input-contenedor">
            <i class="fas fa-user icon"></i>
            <input type="text" placeholder="Usuario" name="userPost" required>
        </div>

        <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
		<input type="password" placeholder="Contraseña" name="passPost" required>
		<span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
	</div>

        <input type="submit" class="button" value="Ingresar">
    </div>
 </form>
       
        <script src="index.js"></script>  

</body>
</html>

