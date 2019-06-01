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
                <input class="easyui-textbox" name="userPost" style="width:100%" data-options="label:'Usuario:',required:true" required>
            </div>
          
            <div style="margin-bottom:20px">
                <input class="easyui-passwordbox" prompt="Password" name="passPost" style="width:100%" data-options="label:'Contraseña:',required:true" required>
            </div>
       
<!--            <div style="margin-bottom:20px">
                <input name="perfilPost" id="tipoPerfil" style="width:100%">
            </div>-->
            
            <div style="text-align:center;padding:5px 0">
                <input type="submit" class="easyui-linkbutton c6" value="Login" style="width:30%;height:40px;">
            </div>     
        </form>
        
    </div>
    
   
<!--    
   <script type="text/javascript">
       
       
        var urlTiposPerfil = 'login/utils.php?metodo=tipoPerfil';
      
        function desplegarPerfiles() {
                $('#tipoPerfil').combobox('reload', urlTiposPerfil); //cada vez que agrega un nuevo cliente recarga los datos 
            }




         $('#tipoPerfil').combobox({
                url: urlTiposPerfil, 
                valueField: 'text', //LO QUE VA A MANDAR AL SERVIDOR: lo que va a guardar 
                textField: 'text', //VISUAL
                required: true, 
                label: 'Tipo Perfil',
                onChange: myKeyUpDoc
                        //keyHandler: myKeyHandler
            });

            function myKeyUpDoc() {
                var cc = $('#tipoPerfil');
                var cantElementosVisibles = cc.combobox('panel').find('div').length;
                var cantElementosOcultos = cc.combobox('panel').find('div:hidden').length;
                var difVisiblesOcultos = Number(cantElementosVisibles) - Number(cantElementosOcultos);
                console.log("cantElementosVisibles", cantElementosVisibles);
                console.log("cantElementosOcultos", cantElementosOcultos);
                console.log("difVisiblesOcultos", difVisiblesOcultos);
                if (difVisiblesOcultos == 0) {
                    $('#tipoPerfil').combobox('panel').find('div:hidden').css('display', 'block');
                }
            }

            var tipoPerfil = $('#tipoPerfil').combobox('textbox');
            tipoPerfil.bind('keydown', function (e) {
                var cc = $('#tipoPerfil');
                if (e.key == 'F1' || e.key == 'OS') {
                    if (cc.combobox('panel').parent().css('display') === 'none') {
                        cc.combobox('showPanel');
                    } else {
                        cc.combobox('hidePanel');
                    }
                }

            });


    </script>-->
    
    
    
    
</body>
</html>

