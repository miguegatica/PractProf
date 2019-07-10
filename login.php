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
        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/demo/demo.css">
        <script type="text/javascript" src="lib/jquery/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery.edatagrid.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="estilos/estilos.css">
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
   
        <style>
    
            body{
                padding: 15px;
            }
            
            #menu{ 
                background-color: #000; 
                overflow: hidden;
            }
            
            #menu ul{
            list-style: none; /*le saco las bolitas a los link*/
            margin: 0;
            padding: 0;
            }

            #menu ul li{
                display: inline-block; 
            }
            
            #menu ul li a{
                color: white; 
                display: block; /*permite que el padding tambien funcione hacia arriba. Sin display: block, solo funciona el padding hacia los lados*/
                padding: 20px 20px; 
                text-decoration: none; /*le quita el subrayado*/
            }
            
            #menu ul li a:hover{
                background-color: #75ACEC; 
            }
            
            .item-r{
                float: right;
            }
        </style>
    

    
    </head>

   <body>
       <nav id="menu">
           <ul>
               <li><a href="#">Backup</a></li>
               <li><a href="respaldos/index.php">Restaurar</a></li>
               <li class="item-r"><a href="empresas/empresas.php">Volver a Empresas</a></li> 
           </ul>
      </nav>
   
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
       
 <script>
		$(document).on('ready', function() {
			$('#show-hide-passwd').on('click', function(e) {
				e.preventDefault();
				var current = $(this).attr('action');
				if (current == 'hide') {
					$(this).prev().attr('type','text');
					$(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
				}
				if (current == 'show') {
					$(this).prev().attr('type','password');
					$(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
				}
			})
		})
	</script>      
       
       
       
       
       
       
</body>
</html>

