<?php 



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
            <a onclick="agregarTabTiposDocs()" href="#" class="easyui-linkbutton" data-options="plain:true">Tipos DOC</a>
            <a onclick="agregarTabCliente()" href="#" class="easyui-linkbutton" data-options="plain:true">Clientes</a>
        </nav>
        <br>
        <br>
        <br>
        <div id="maintab" class="easyui-tabs" data-options="fit:false,border:true,plain:true" style="height: 500px;">
            
        </div>
  </div> 
    
</body>
</html>

<script src="index.js"></script> 




