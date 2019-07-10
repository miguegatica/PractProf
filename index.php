<?php


include_once(dirname(__FILE__) . '/login/empresaok.php');
include_once(dirname(__FILE__) . '/login/loginok.php');
include_once(dirname(__FILE__) . '/lib/migrations.php');

/* LO QUE HACE LO SIGUIENTE ES OBTENER EN UNA VAR $buttons LOS BOTONES DE DETERMINADO MODULO QUE PUEDE TENER DICHO CLIENTE */
$module_name = 'GENERAL';
include_once(dirname(__FILE__) . '/lib/buttons_retrieve.php');
//Con simplemente agregar la linea anterior en todos los archivos, ya seabemos si existe o no existe
//Si tienes dos pestañas abiertas del mismo navegador, no deja hacer amb si en algunas de las pesatañas cerre sesion 
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
        <div>  
            <nav style="padding:10px 0px;border:1px solid #ddd;position: fixed;top: 0;left: 0;z-index: 1050;width: 100%;" >
                <?php writeButtons("mm1", $buttons, $mm1); ?>
                <a href="login.php" class="easyui-linkbutton" data-options="plain:true" iconcls="icon-cancel">Salir</a>
            </nav>
            <br>
            <br>
            <br>
            <div id="maintab" class="easyui-tabs" data-options="fit:false,border:true,plain:true" >

            </div>
        </div> 

    </body>
</html>
<?php

//Este escribe de a varios botones
function writeButtons($div, &$buttons, &$mm, $dontwrite = "", $only = "") {

    foreach ($buttons as $button) {
        if ($button['divparent'] == $div) {
            $mm = true;
            //Solo dibujar si es distinto a dontwrite o igual a only
            if ($button['idselector'] != $dontwrite)
                echo $button['html'];
            //Si hay que dibujar un separador a continuacion dibujarlo
            if ($button['nextseparator'] == "true") {
                echo '<div class="menu-sep btnhidden"></div>';
            }
        }
    }
}

//Este escribe un solo boton.
function writeButton($idselector, &$buttons, &$mm) {
    foreach ($buttons as $button) {
        if ($button['idselector'] == $idselector) {
            $mm = true;
            echo $button['html'];
            //Si hay que dibujar un separador a continuacion dibujarlo
            if ($button['nextseparator'] == "true") {
                echo '<div class="menu-sep btnhidden"></div>';
            }
        }
    }
}
?>
<script src="index.js"></script> 


<script>
var largo = document.documentElement.clientHeight;
    var ancho = document.documentElement.clientWidth;
$('#maintab').css('height',largo-80);
</script>

