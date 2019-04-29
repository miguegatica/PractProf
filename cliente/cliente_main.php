Fny<?php 


?><!DOCTYPE html>
<html>
<body>
    
    <table id="dgClientes" title="Clientes" class="easyui-datagrid" style="width:700px;height:250px"
            url="cliente/cliente_retrieve.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="id" width="50" hidden=true>ID</th>
                <th field="num_cliente" width="50" >Nro Cliente</th>
                <th field="apellido" width="50">Apellido</th>
                <th field="nombre" width="50">Nombre</th>
                <th field="nro_documento" width="50">Numero documento</th>
                <th field="tipodocumento_id" width="50" hidden="true">Tipo documento</th>
<!--                nueva columna agregada. Ir a cliente_retrieve.php-->
                <th field="tipodoc_descripcion" width="50" >Tipo documento</th> 
                
               
   
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoCliente()">Nuevo Cliente</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarCliente()">Editar Cliente</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarCliente()">Eliminar Cliente</a>
    </div>
    
    <!--El name es lo que le va a llegar al PHP.., con el name php va a reconocer el REQUEST, por el campo name-->
<!--    el id es para el front-->
<!--    el name es para el backend-->
<!--Cuando el usuario apreta el tipodocumento_id (fk) entonces le salta el nro_afip-->
    
    
    <div id="dlgCliente" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgCliente-buttons'">
        <form id="fmCliente" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion de Cliente</h3>
            <div style="margin-bottom:10px">
                <input name="num_cliente" class="easyui-textbox" required="true" label="Num Cliente:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Nombres:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="tipodocumento_id" id="tipodocumento_id" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nro_documento" class="easyui-textbox" required="true" label="Nro Doc:" style="width:100%">
            </div>
        </form>
        
    </div>
    <div id="dlgCliente-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCliente()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgCliente').dialog('close')" style="width:90px">Cancelar</a>
    </div>
  

    <script type="text/javascript">
        var url;
        var urlTiposDoc = 'cliente/utils.php?metodo=tiposdoclist';//desde el front estoy mandando los datos al backend por el metodo get
       
    
    
    
        function nuevoCliente(){
            $('#tipodocumento_id').combobox('reload', urlTiposDoc); //cada vez que agrega un nuevo cliente recarga los datos 
            $('#dlgCliente').dialog('open').dialog('center').dialog('setTitle','Nuevo Cliente');
            $('#fmCliente').form('clear');
            url = 'cliente/cliente_save.php';
        }
 
        function editarCliente(){
            //row va a ser un objeto de javascript que va a contener el registro del cliente
            var row = $('#dgClientes').datagrid('getSelected');
            //if eligio una fila, abro el dialog de cliente, lo centra, seteo el titulo y le doy 'Editar Cliente'
            if (row){
                $('#dlgCliente').dialog('open').dialog('center').dialog('setTitle','Editar Cliente');
                //...y en el formulario hago un load(cargar) ese registro o fila. Se autocompletan los campos 
                $('#fmCliente').form('load',row);
                //...ahora la url va a ser esa ruta, donde le voy a mandar por GET el id 
                url = 'cliente/cliente_update.php?id='+row.id;
            }
        }
    
        function saveCliente(){
            $('#fmCliente').form('submit',{
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
                        $('#dlgCliente').dialog('close');        // close the dialog
                        $('#dgClientes').datagrid('reload');    // reload the cliente data
                    }
                }
            });
        }
        function eliminarCliente(){
            var row = $('#dgClientes').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','Esta seguro de que desea eliminar?',function(r){
                    if (r){
                        //le estoy mandando el id por POST
                        $.post('cliente/cliente_destroy.php',{id:row.id},function(result){
                            if (result.errorMsg){
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dgClientes').datagrid('reload');    // reload the cliente data
                            }
                        },'json');
                    }
                });
            }
        }
        
    //jquery yo quiero que mi input sea una combobox, que se despliegue..anda a buscarlo en la url
    $('#tipodocumento_id').combobox({
        url:urlTiposDoc, //va a traer los datos de esa url para mostrar los campos Id y el Text(concatenado)
        valueField:'id', //LO QUE VA A MANDAR AL SERVIDOR: lo que va a guardar 
        textField:'text',//VISUAL: el concatenado
        required:true, //que sea requerido, lo pone en rojo 
        label:'Tipo Doc:'
    });
    </script>
</body>
</html>