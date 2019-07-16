<?php

include_once(dirname(__FILE__) . '/../login/loginok.php');
include_once(dirname(__FILE__) . '/../lib/connections/conn.php');
$db = null;
if (crearConexion($db)) {




//NO TOCAR PARA ARRIBA!*********************************************************
//NO TOCAR PARA ARRIBA!*********************************************************
//NO TOCAR PARA ARRIBA!*********************************************************
//NO TOCAR PARA ARRIBA!*********************************************************



    if (!migrationOkDB($db, "migration_1")) {
        
        if ($rta = $db->query(" INSERT INTO perfilusuario (perfil)
                            VALUES ('superadmin')
                            ON DUPLICATE KEY UPDATE
                            perfil = perfil;")){
            
            checkparameterlogin($db, 'perfilusuario_superadmin', $db->insert_id);
        }
        
        
        
        
        $module = "GENERAL";
        $prefix = "btnGeneral_";

        createRowsGeneralButtons($db, $module, $prefix . "usuarios",        "Usuarios",         "agregarTabUsuario()",      "icon-man",         "easyui-linkbutton", "mm1", "a");
        createRowsGeneralButtons($db, $module, $prefix . "permisos",        "Permisos",         "agregarTabPermisos()",     "icon-hlock",       "easyui-linkbutton", "mm1", "a");
        createRowsGeneralButtons($db, $module, $prefix . "tiposdocumentos", "Tipos Documentos",  "agregarTabTiposDocs()",    "icon-record2",     "easyui-linkbutton", "mm1", "a");
        createRowsGeneralButtons($db, $module, $prefix . "clientes",        "Clientes",         "agregarTabCliente()",      "icon-man",         "easyui-linkbutton", "mm1", "a");
        createRowsGeneralButtons($db, $module, $prefix . "auditoriaclientes", "Auditoria Clientes",  "agregarTabAuditoriaClient()",    "icon-record2",     "easyui-linkbutton", "mm1", "a");
        createRowsGeneralButtons($db, $module, $prefix . "auditoriaafip", "Auditoria Afip",  "agregarTabAuditoriaDoc()",    "icon-record2",     "easyui-linkbutton", "mm1", "a");    
        
        
        $module = "CLIENTES";
        $prefix = "btnClientes_";
        createRowsGeneralButtons($db, $module, $prefix . "nuevoCliente", "Nuevo Cliente", "nuevoCliente()", "icon-add", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "editarCliente", "Editar Cliente", "editarCliente()", "icon-edit", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "eliminarCliente", "Eliminar Cliente", "eliminarCliente()", "icon-remove", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "filtrarCliente", "Filtrar Cliente", "filtrarCliente()", "icon-filter", "easyui-linkbutton", "", "a");
        
        
        $module = "USUARIOS";
        $prefix = "btnUsuarios_";
        createRowsGeneralButtons($db, $module, $prefix . "nuevoUsuario", "Nuevo Usuario", "nuevoUsuario()", "icon-add", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "editarUsuario", "Editar Usuario", "editarUsuario()", "icon-edit", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "eliminarUsuario", "Eliminar Usuario", "eliminarUsuario()", "icon-remove", "easyui-linkbutton", "", "a");

        $module = "TIPOSDOCUMENTOS";
        $prefix = "btnTiposdocumentos_";
        createRowsGeneralButtons($db, $module, $prefix . "nuevoDocumento", "Nuevo Documento", "nuevoDocumento()", "icon-add", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "editarDocumento", "Editar Documento", "editarDocumento()", "icon-edit", "easyui-linkbutton", "", "a");
        createRowsGeneralButtons($db, $module, $prefix . "eliminarDocumento", "Eliminar Documento", "eliminarDocumento()", "icon-remove", "easyui-linkbutton", "", "a");
   
//        $module = "AUDITORIACLIENTES";
//        $prefix = "btnAuditoriaclientes_";
    }



    







//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//NO TOCAR PARA ABAJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!




    $db->close();
}

function migrationOkDB(&$db, $name) {
    $query = "SELECT count(migrations.id) as cant FROM migrations WHERE migrations.name='$name' ";
    $cant = 0;
    $cant = $db->query($query)->fetch_object()->cant;


    if ($cant == 0) {


        $now = date("Y-m-d H:i:s", time());

        $query = "insert into migrations (name, date) values ('$name','$now')";


        $db->query($query);

        return false;
    }

    return true;
}
