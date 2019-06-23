<?php
    include_once(dirname(__FILE__).'/../login/loginok.php');
    //LA SIGUIENTE VARIABLE ES OBLIGATORIA PARA CHEQUEAR QUE COLUMNAS UTILIZA EL OPERADOR!
    $module_name = 'CLIENTES';
    include_once(dirname(__FILE__).'/../lib/buttons_retrieve.php');

    /////////////////////////////////////////////////////////////////////////////////////
?><!DOCTYPE html>
<html>
    <body>

        <table id="dgClientes" title="Clientes" class="easyui-datagrid" style="width:700px;height:300px"
               url="cliente/cliente_retrieve.php"
               toolbar="#toolbarClientes" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="id" width="50" hidden=true sortable="true">ID</th>
                    <th field="num_cliente" width="35" sortable="true">Nro Cliente</th>
                    <th field="apellido" width="50" sortable="true">Apellido</th>
                    <th field="nombre" width="50"sortable="true">Nombre</th>
                    <th field="nro_documento" width="50" sortable="true">Numero documento</th>
                    <th field="tipodocumento_id" width="50" hidden="true" sortable="true">Tipo documento</th>
                    <th field="tipodoc_descripcion" width="50" sortable="true" >Tipo documento</th> 


                </tr>
            </thead>
        </table>

        <div id="toolbarClientes">
            <?php 
            foreach($buttons as $button){
                echo $button['html'];
            }?>
        </div>


        
        <div id="dlgCliente" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgCliente-buttons'">

            <form id="fmCliente" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Información de Cliente</h3>
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
                    <input name="nro_documento" class="easyui-textbox" required="true" label="Nro Doc:" style="width:100%">
                </div>


                <!--       ****************** Combobox tipodocumento *************************************     -->

                <div style="margin-bottom:10px">
                    <input name="tipodocumento_id" id="tipodocumento_id" style="width:100%">
                </div>

                <div id="dlgCliente-buttons">
                     <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCliente()" style="width:90px">Guardar</a>
                     <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgCliente').dialog('close')" style="width:90px">Cancelar</a>
                </div>
            
            </form>

                
        </div> 
        
        <div id="wCustomerFilter" class="easyui-window windowCust" title='Filtrar Clientes' data-options="modal:true,closed:true,iconCls:'icon-filter',collapsible:false, minimizable:false, maximizable:false,resizable:false" style="width:412px;height:700px;"> 
        
             <div style="margin-left: 10px;margin-top: 10px;">
                Tipo Documento <br> <input id="ftipodocumento_id" class="easyui-combobox"  style="width:380px;" name="tipodocumento_id" > <br>  
               
                <input id="ccBlockDateF" class="easyui-combobox"  style="width:380px;" name="cBlockDateF" > <br> <br>
                <a href="#" class="easyui-linkbutton" style="width: 40%; margin-top: 15px;" data-options="iconCls:'icon-filter'" onclick="doCustFilter()" >Filtrar</a>
                <a href="#" class="easyui-linkbutton" style="width: 40%; margin-top: 15px;margin-left: 15%;" data-options="iconCls:'icon-cancel'" onclick="$('#wCustomerFilter').window('close');">Cancelar</a>
            </div>
    
        </div>
        
        <script type="text/javascript">

            var url;
            var urlTiposDoc = 'cliente/utils.php?metodo=tiposdoclist';//desde el front estoy mandando los datos al backend por el metodo get





            function nuevoCliente() {
                $('#tipodocumento_id').combobox('reload', urlTiposDoc); //cada vez que agrega un nuevo cliente recarga los datos 
                $('#dlgCliente').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Cliente');
                $('#fmCliente').form('clear');
                url = 'cliente/cliente_save.php';
            }




            function editarCliente() {
                //row va a ser un objeto de javascript que va a contener el registro del cliente
                var row = $('#dgClientes').datagrid('getSelected');
                //if eligio una fila, abro el dialog de cliente, lo centra, seteo el titulo y le doy 'Editar Cliente'
                if (row) {
                    $('#dlgCliente').dialog('open').dialog('center').dialog('setTitle', 'Editar Cliente');
                    //...y en el formulario hago un load(cargar) ese registro o fila. Se autocompletan los campos 
                    $('#fmCliente').form('load', row);
                    //...ahora la url va a ser esa ruta, donde le voy a mandar por GET el id 
                    url = 'cliente/cliente_update.php?id=' + row.id;
                }
            }




            function saveCliente() {
                $('#fmCliente').form('submit', {
                    url: url,
                    onSubmit: function () {
                        return $(this).form('validate');
                    },
                    success: function (result) {
                        var result = eval('(' + result + ')');
                        if (result.errorMsg) {
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
            function eliminarCliente() {
                var row = $('#dgClientes').datagrid('getSelected');
                if (row) {
                    $.messager.confirm('Confirmar', '¿Està seguro que desea eliminar?', function (r) {
                        if (r) {
                            //le estoy mandando el id por POST
                            $.post('cliente/cliente_destroy.php', {id: row.id}, function (result) {
                                if (result.errorMsg) {
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    $('#dgClientes').datagrid('reload');    // reload the cliente data
                                }
                            }, 'json');
                        }
                    });
                }
            }





            $('#tipodocumento_id').combobox({
                url: urlTiposDoc, 
                valueField: 'id', //LO QUE VA A MANDAR AL SERVIDOR: lo que va a guardar 
                textField: 'text', //VISUAL: el concatenado
                required: true, //que sea requerido, lo pone en rojo 
                label: 'Tipo Doc:',
                onChange: myKeyUpDoc
                        //keyHandler: myKeyHandler
            });

            function myKeyUpDoc() {
                var cc = $('#tipodocumento_id');
                var cantElementosVisibles = cc.combobox('panel').find('div').length;
                var cantElementosOcultos = cc.combobox('panel').find('div:hidden').length;
                var difVisiblesOcultos = Number(cantElementosVisibles) - Number(cantElementosOcultos);
                console.log("cantElementosVisibles", cantElementosVisibles);
                console.log("cantElementosOcultos", cantElementosOcultos);
                console.log("difVisiblesOcultos", difVisiblesOcultos);
                if (difVisiblesOcultos == 0) {
                    $('#tipodocumento_id').combobox('panel').find('div:hidden').css('display', 'block');
                }

            }

            var tipodocumento_id = $('#tipodocumento_id').combobox('textbox');
            tipodocumento_id.bind('keydown', function (e) {
                var cc = $('#tipodocumento_id');
                if (e.key == 'F1' || e.key == 'OS') {
                    if (cc.combobox('panel').parent().css('display') === 'none') {
                        cc.combobox('showPanel');
                    } else {
                        cc.combobox('hidePanel');
                    }
                }

            });



            function filtrarCliente(){

                //$('#ftipodocumento_id').combobox('reload', urlTiposDoc); 
                $('#ftipodocumento_id').combobox({
                    url: urlTiposDoc, 
                    valueField: 'id', //LO QUE VA A MANDAR AL SERVIDOR: lo que va a guardar 
                    textField: 'text', //VISUAL: el concatenado
                    label: 'Tipo Doc:'
                });
                $('#wCustomerFilter').window('open');
            }
            
            
            function doCustFilter() {
                //Se asigna el valor a variables para analizar si estan vacias
                var ftipodocumento_id = $('#ftipodocumento_id').combobox('getValue');
                console.log(ftipodocumento_id);
                //Si cualquiera de las variables contiene algo es porque quizo filtrar
                if (ftipodocumento_id !== '') {
                    $.messager.progress();
                    //Se vuelve a llamar al evento load del datatable para que este se conecte al servidor solicitando de nuevo los datos pero ya con un filtro
                    console.log('Filtrara');
                    $('#dgClientes').datagrid('load',{
                        ftipodocumento_id: ftipodocumento_id
                    }); 
       
                    console.log('Filtro');
                    
                    $.messager.progress('close');
                }

                $('#wCustomerFilter').window('close');


            }
        </script>
    </body>
</html>
