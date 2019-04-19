<?php 


?>
<!DOCTYPE html>
<html>

<body>
    <br>
    <h2>Documento identificatorio del comprador</h2>

    <table id="dgTiposDocAfip" title="Documentos" style="width:auto;height:250px"
            toolbar="#toolbar" pagination="true" idField="id"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="id" width="50" hidden=true>ID</th>
                <th field="nro_afip" width="50" editor="{type:'validatebox',options:{required:true}}">Nro AFIP</th>
                <th field="descripcion" width="50" editor="{type:'validatebox',options:{required:true}}">Descripcion</th>
                <th field="sigla" width="50" editor="{type:'validatebox',options:{required:true}}">Sigla</th>
   
            </tr>
        </thead>
    </table>
    
    <div id="toolbarTiposDoc">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dgTiposDocAfip').edatagrid('addRow')">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dgTiposDocAfip').edatagrid('destroyRow')">Eliminar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dgTiposDocAfip').edatagrid('saveRow')">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dgTiposDocAfip').edatagrid('cancelRow')">Cancelar</a>
    </div>
    
    <script type="text/javascript">
        $(function(){
            $('#dgTiposDocAfip').edatagrid({ 
                toolbar:'#toolbarTiposDoc',
                url: 'afip/tiposdoc_retrieve.php',
                saveUrl: 'afip/tiposdoc_save.php',
                updateUrl: 'afip/tiposdoc_update.php',
                destroyUrl: 'afip/tiposdoc_destroy.php',
                onError: function(index,row){
                    
                    var result  = eval('('+row.jqXHR.responseText+')');
                    $.messager.alert("Error" , result['message'] ,'error');
                    $('#dgTiposDocAfip').datagrid('reload');
                    
                }
            });
        });
        
        
        
    </script>
    
</body>
</html>

