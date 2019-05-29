<?php 

include_once(dirname(__FILE__).'/lib/utils.php');

if(is_session_started() == false){
    //Si esta apagada la session la enscendemos
    session_start();
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
        
        
    </head>
   <body>
  <h2>Login</h2>
    <p>Ingrese sus datos</p>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" title="Iniciar sesión" style="width:100%;max-width:400px;padding:30px 60px;">
     
      
        <form id="ff" method="post" action="login/acceso.php">
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="user" style="width:100%" data-options="label:'Usuario:',required:true" required>
            </div>
          
            <div style="margin-bottom:20px">
                <input class="easyui-passwordbox" prompt="Contraseña" name="pass" style="width:100%" data-options="label:'Constraseña:',required:true" required>
            </div>
       
            
            <div style="text-align:center;padding:5px 0">
                <input type="submit" value="Login">
            </div>      
        </form>
        
    </div>
    
</body>
</html>


<!-- imput type="submit" me manda todos los datos del formulario al direcctioro de action = ""-->
<!--value="Login" es el nombre del boton-->
<!--lo que tiene name = "" es lo que va a enviar al servidor  por el metodo "get" o "post"--> 