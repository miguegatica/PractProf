<?php 


?>

<html>
   <head>
    <meta charset="UTF-8">
    <title>Validate Password - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../demo.css">
    <script type="text/javascript" src="../../jquery.min.js"></script>
    <script type="text/javascript" src="../../jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Login</h2>
    <p>Ingrese sus datos</p>
    <div style="margin:20px 0;"></div>
    
    <div class="easyui-panel" title="Iniciar sesión" style="width:100%;max-width:500px;padding:30px 60px;">
     
        <form id="ff" method="post" action="superLogin/usuario_save.php">
            
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" prompt="Apellido" name="surnamePost" style="width:100%;height:34px;padding:10px" data-options="label:'Apellido:',required:true" required>
            </div>
            
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" prompt="Nombre" name="namePost" style="width:100%;height:34px;padding:10px" data-options="label:'Nombre:',required:true" required>
            </div>
            
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" prompt="Nick" name="userPost" style="width:100%;height:34px;padding:10px" data-options="label:'Nick:',required:true" required>
            </div>
          
            <div style="margin-bottom:20px">
                <input class="easyui-passwordbox" prompt="Contraseña" name="passPost" iconWidth="28"  style="width:100%;height:34px;padding:10px" data-options="label:'Contraseña:',required:true" required>
            </div>
            
            <div style="margin-bottom:20px">
                <input class="easyui-passwordbox" prompt="Confirmar constraseña" style="width:100%;height:34px;padding:10px" data-options="label:'Confirmar contraseña:',required:true" required>
            </div>
            
            <div style="margin-bottom:20px">
                <input name="perfilPost" id="tipoPerfil" style="width:100%">
            </div>
            
            <div style="text-align:center;padding:5px 0">
                <input type="submit" class="easyui-linkbutton c6" value="Login" style="width:30%;height:40px;">
            </div>      
      
        </form>
        
    </div>
    
    
   
    
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


    </script>
    
    
    
 
</body>
</html> 


















<!--
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Validate Password - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="../../themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../demo.css">
    <script type="text/javascript" src="../../jquery.min.js"></script>
    <script type="text/javascript" src="../../jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Validate Password</h2>
    <p>This example shows how to validate whether a user enters the same password.</p>
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" style="width:400px;padding:50px 60px">
        <div style="margin-bottom:20px">
            <input class="easyui-textbox" prompt="Username" iconWidth="28" style="width:100%;height:34px;padding:10px;">
        </div>
        <div style="margin-bottom:20px">
            <input id="pass" class="easyui-passwordbox" prompt="Password" iconWidth="28" style="width:100%;height:34px;padding:10px">
        </div>
        <div style="margin-bottom:20px">
            <input class="easyui-passwordbox" prompt="Confirm your password" iconWidth="28" validType="confirmPass['#pass']" style="width:100%;height:34px;padding:10px">
        </div>
    </div>
 
    <script type="text/javascript">
        $.extend($.fn.validatebox.defaults.rules, {
            confirmPass: {
                validator: function(value, param){
                    var pass = $(param[0]).passwordbox('getValue');
                    return value == pass;
                },
                message: 'Password does not match confirmation.'
            }
        })
    </script>
</body>
</html>-->