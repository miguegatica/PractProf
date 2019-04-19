<?php 


?>
<!DOCTYPE html>
<html>

<body>
    <br>
    <h2>Todos los Clientes</h2>

    <table id="dgClientes" title="Documentos" style="width:auto;height:250px"
            toolbar="#toolbar" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="id" width="50" hidden=true>ID</th>
                <th field="num_cliente" width="50" editor="{type:'validatebox',options:{required:true}}">Nro Cliente</th>
                <th field="apellido" width="50" editor="{type:'validatebox',options:{required:true}}">Apellido</th>
                <th field="nombre" width="50" editor="{type:'validatebox',options:{required:true}}">Nombre</th>
                <th field="nro_afip" width="50" editor="{type:'validatebox',options:{required:true}}">Numero AFIP</th>
                <th field="nro_documento" width="50" editor="{type:'validatebox',options:{required:true}}">Numero documento</th>
                <th field="tipodocumento_id" width="50" editor="{type:'validatebox',options:{required:true}}">Tipo documento</th>
               
   
            </tr>
        </thead>
    </table>
    
    <div id="toolbarClientes">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dgClientes').edatagrid('addRow')">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dgClientes').edatagrid('destroyRow')">Eliminar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dgClientes').edatagrid('saveRow')">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dgClientes').edatagrid('cancelRow')">Cancelar</a>
    </div>
    
    <script type="text/javascript">
        $(function(){
            $('#dgClientes').edatagrid({ 
                toolbar:'#toolbarClientes',
                url: 'cliente/cliente_retrieve.php',
                saveUrl: 'cliente/cliente_save.php',
                updateUrl: 'cliente/cliente_update.php',
                destroyUrl: 'cliente/cliente_destroy.php',
                onError: function(index,row){
                    
                    var result  = eval('('+row.jqXHR.responseText+')');
                    $.messager.alert("Error" , result['message'] ,'error');
                    $('#dgClientes').datagrid('reload');
                    
                }
            });
        });
        
        
        
    </script>
    
</body>
</html>

