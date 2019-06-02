<?php


?>

<!DOCTYPE html>
<html>
    <body>

        <table id="dgUsuarios" title="Clientes" class="easyui-datagrid" style="width:700px;height:300px"
               url="usuarios/usuario_retrieve.php"
               toolbar="#toolbarUsuarios" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="id" width="50" hidden=true sortable="true">ID</th>
                    <th field="nombre" width="35" sortable="true">Nombre</th>
                    <th field="apellido" width="50" sortable="true">Apellido</th>
                    <th field="nick" width="50" sortable="true">Nick</th>
                    <th field="contraseña" width="50" sortable="true">Contraseña</th>
                    <th field="tipoperfil_id" width="50" hidden="true" sortable="true">Perfil</th>
                    <th field="tipoperfil_descripcion" width="50" sortable="true" >Perfil</th> 

                </tr>
            </thead>
        </table>

        <div id="toolbarUsuarios">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoUsuario()">Nuevo Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarUsuario()">Editar Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarUsuario()">Eliminar Usuario</a>
        </div>

        <div id="dlgUsuario" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgUsuario-buttons'">


            <form id="fmUsuario" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Información de Cliente</h3>
               
                <div style="margin-bottom:10px">
                    <input name="nombre" class="easyui-textbox" required="true" label="Nombres:" style="width:100%">
                </div>
                
                <div style="margin-bottom:10px">
                    <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
                </div>
                

                <div style="margin-bottom:10px">
                    <input name="nick" class="easyui-textbox" required="true" label="Nick:" style="width:100%">
                </div>
                
                <div style="margin-bottom:10px">
                    <input name="contraseña" class="easyui-textbox" required="true" label="Contraseña:" style="width:100%">
                </div>


                <!--       ****************** Combobox tipodocumento *************************************     -->

                <div style="margin-bottom:10px">
                    <input name="tipoperfil_id" id="tipoperfil_id" style="width:100%">
                </div>

            </form>




            <!--   *********** Botones de formulario *********************     -->

        </div>
        <div id="dlgUsuario-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsuario()" style="width:90px">Guardar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUsuario').dialog('close')" style="width:90px">Cancelar</a>
        </div>

        <!--  **********************************************************************-->


<!--
        <script type="text/javascript">

           // var url;
            var urlTiposPerfil = 'login/utils.php?metodo=tipoPerfil';
      
            function nuevoUsuario() {
                $('#tipoperfil_id').combobox('reload', urlTiposPerfil); //cada vez que agrega un nuevo cliente recarga los datos 
                $('#dlgUsuario').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Cliente');
                $('#fmUsuario').form('clear');
                url = 'usuarios/usuario_save.php';
            }




            function editarUsuario() {
                //row va a ser un objeto de javascript que va a contener el registro del cliente
                var row = $('#dgUsuarios').datagrid('getSelected');
                //if eligio una fila, abro el dialog de cliente, lo centra, seteo el titulo y le doy 'Editar Cliente'
                if (row) {
                    $('#dlgUsuario').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
                    //...y en el formulario hago un load(cargar) ese registro o fila. Se autocompletan los campos 
                    $('#fmUsuario').form('load', row);
                    //...ahora la url va a ser esa ruta, donde le voy a mandar por GET el id 
                    url = 'usuarios/usuario_update.php?id=' + row.id;
                }
            }




            function saveUsuario() {
                $('#fmUsuario').form('submit', {
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
                            $('#dlgUsuario').dialog('close');        // close the dialog
                            $('#dgUsuarios').datagrid('reload');    // reload the cliente data
                        }
                    }
                });
            }
            function eliminarUsuario() {
                var row = $('#dgUsuarios').datagrid('getSelected');
                if (row) {
                    $.messager.confirm('Confirmar', '¿Està seguro que desea eliminar?', function (r) {
                        if (r) {
                            //le estoy mandando el id por POST
                            $.post('usuarios/usuario_destroy.php', {id: row.id}, function (result) {
                                if (result.errorMsg) {
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    $('#dgUsuarios').datagrid('reload');    // reload the cliente data
                                }
                            }, 'json');
                        }
                    });
                }
            }




            function desplegarPerfiles() {
                        $('#tipoperfil_id').combobox('reload', urlTiposPerfil); //cada vez que agrega un nuevo cliente recarga los datos 
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
