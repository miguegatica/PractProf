<?php 

include_once(dirname(__FILE__).'/../login/loginok.php');

?>

<!DOCTYPE html>
<html>
<body>
    
    <table id="dgDocumentos" title="Documentos" class="easyui-datagrid" style="width:700px;height:300px"
            url="afip/tiposdoc_retrieve.php"
            toolbar="#toolbarDocumentos" pagination="true" 
            rownumbers="true" fitColumns="true" singleSelect="true" sortName="sigla"
            sortOrder="asc">
        <thead>
            <tr>
                <th field="id" width="50" hidden=true sortable="true">ID</th>
                <th field="nro_afip" width="50" sortable="true">Nro AFIP</th>
                <th field="sigla" width="50"sortable="true">Sigla</th>
                <th field="descripcion" width="80" sortable="true">Descripcion</th>
          </tr>
        </thead>
    </table>

    
    <div id="toolbarDocumentos">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoDocumento()">Nuevo Documento</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarDocumento()">Editar Documento</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarDocumento()">Eliminar Documento</a>
    </div>
    
  
  
    <div id="dlgDocumentos" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgDocumentos-buttons'">
        <form id="fmDocumento" method="post" novalidate style="margin:0;padding:20px 50px" style=>
            <h3>Tipos de documentos</h3>
            <div style="margin-bottom:10px">
                <input name="nro_afip" class="easyui-textbox" required="true" label="numero afip:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="descripcion" class="easyui-textbox" required="true" label="descripcion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="sigla" class="easyui-textbox" required="true" label="sigla:" style="width:100%">
            </div>
            
            <div id="dlgDocumentos-buttons">
               <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveDocumento()" style="width:90px">Guardar</a>
               <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDocumentos').dialog('close')" style="width:90px">Cancelar</a>
            </div>
            
        </form>
    </div>
       

   
  

   

      
     <script type="text/javascript">  
     var url;
     
      function nuevoDocumento(){
          //  $('#tipodocumento_id').combobox('reload', urlTiposDoc); //cada vez que agrega un nuevo cliente recarga los datos 
            $('#dlgDocumentos').dialog('open').dialog('center').dialog('setTitle','Nuevo Documento');
            $('#fmDocumento').form('clear');
            url = 'afip/tiposdoc_save.php';
        }
 
        function editarDocumento(){
            //row va a ser un objeto de javascript que va a contener el registro del cliente
            var row = $('#dgDocumentos').datagrid('getSelected');
            //if eligio una fila, abro el dialog de cliente, lo centra, seteo el titulo y le doy 'Editar Cliente'
            if (row){
                $('#dlgDocumentos').dialog('open').dialog('center').dialog('setTitle','Editar Documento');
                //...y en el formulario hago un load(cargar) ese registro o fila. Se autocompletan los campos 
                $('#fmDocumento').form('load',row);
                //...ahora la url va a ser esa ruta, donde le voy a mandar por GET el id 
                url = 'afip/tiposdoc_update.php?id='+row.id;
            }
        }
    
        function saveDocumento(){
            $('#fmDocumento').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlgDocumentos').dialog('close');        // close the dialog
                        $('#dgDocumentos').datagrid('reload');    // reload the cliente data
                    }
                }
            });
        }
        
        function eliminarDocumento(){
            var row = $('#dgDocumentos').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Està seguro que desea eliminar?',function(r){
                    if (r){
                        //le estoy mandando el id por POST
                        $.post('afip/tiposdoc_destroy.php',{id:row.id},function(result){
                            if (result.errorMsg){
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dgDocumentos').datagrid('reload');   
                            }
                        //desde aca es otro tipo de error, falla de fk en mysql
                        },'json').fail(function(xhr, status, error) {
                            //console.log(xhr);
                            var result  = eval('('+xhr.responseText+')');
                            $.messager.alert("Error" , result['errorMsg'] ,'error');
                            //$('#dgTiposDocAfip').datagrid('reload'); //ACA SOLO RECARGA LOS DATOS SI HAY UN ERROR ? 
                        });;
     
                    }
                });
            }
        }
        
        
    //jquery yo quiero que mi input sea una combobox, que se despliegue..anda a buscarlo en la url
//    $('#tipodocumento_id').combobox({
//        url:urlTiposDoc, //va a traer los datos de esa url para mostrar los campos Id y el Text(concatenado)
//        valueField:'id', //LO QUE VA A MANDAR AL SERVIDOR: lo que va a guardar 
//        textField:'text',//VISUAL: el concatenado
//        required:true, //que sea requerido, lo pone en rojo 
//        label:'Tipo Doc:'
//    });
    
    
    </script>
</body>
</html>