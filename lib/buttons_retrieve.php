<?php

/* DEVUELVE LOS BOTONES QUE PUEDE VER EL CLIENTE DE DETERMINADO MODULO EN ARRAY $buttons !! */

include_once(dirname(__FILE__) . '/../lib/connections/conn.php');
include_once(dirname(__FILE__) . '/../lib/utils.php');

$db = null;
if (crearConexion($db)) {
    
    //Body me dice si es del menu de arriba o es es un boton comun dentro de alguna ventana...
    if (!isset($body)) {
        $body = '0';
    }

    $idHie = $_SESSION['operator_profile'];
    $idOp = $_SESSION['SESS_MEMBER_ID'];
    //createButtonsOp($op,$module_name);
    //enabledButton("5","CUSTOMERS","btnCustomer_borrarpk");

    
    createGeneralButtonsHie($db, $idHie, $module_name);

    $buttons = array();

    //No olvidar que support me dice si es solo para soporte.
    $support = "";
    if ($_SESSION['SESS_MEMBER_ID'] != '99') {
        //Si no es soporte NO le dejo ver los botones de soporte.
        $support = "permisos.support='false' and";
    }
    $query = "select * 
                from permisos 
                where $support  permisos.module='$module_name' and permisos.body='$body' and permisos.id in (
                select permiso_id from permisos_perfiles where permisos_perfiles.perfil_id='$idHie' and permisos_perfiles.can='1') order by permisos.id";

    if ($idHie == '99') {
        //Si es SOPORTE tomo cualquier perfil y pido que me traiga sus botones, pero SIN EL CAN (poder) en el WHERE, asi me trae todos los botones.
        //Pero para esto el idHie tiene que existir por eso hago la primer query.
        $firstHie = $db->query("select perfilusuario.id from perfilusuario limit 1")->fetch_object()->id;
        $query = "select * 
                from permisos 
                where $support  permisos.module='$module_name' and permisos.body='$body' and permisos.id in (
                select permiso_id from permisos_perfiles where permisos_perfiles.perfil_id='$firstHie') order by permisos.id";
    }

    if ($result1 = $db->query($query)) {
        while ($row = $result1->fetch_object()) {
            $ok = true;
            //Valida el params solo si NO es SOPORTE, SOPORTE puede ver TODO!
            if (!empty($row->param) and $idHie != '99') {
                $val = "";
                checkParamaterDBOpened($db, $val, $row->param);
                if ($row->paramval != $val) {
                    //Si no es igual sali al siguiente boton.
                    $ok = false;
                }
            }
            if ($ok) {
                $title = $row->title;
                $titles = explode(";", $title);
                $lastTitle = $titles[(count($titles) - 1)];

                $titlelang = $lastTitle;
                //Si tiene traduccion traducir...
                if (isset($tr[$lastTitle])) {
                    $titlelang = $tr[$lastTitle];
                }
                //Element es si es un <a> o un <div> ...

                if (isset($tr[$lastTitle])) {
                    $titlelang = $tr[$lastTitle];
                }

                $classTooltip = "";
                $messageTooltip = "";
                if ($row->tooltip == "true") {
                    $classTooltip = " easyui-tooltip ";
                    $messageTool = $row->messagetool;
                    if (isset($tr[$messageTool])) {
                        $messageTool = $tr[$messageTool];
                    }
                    $messageTooltip = ' title="' . $messageTool . '" ';
                }

                $rightButton = "";
                if ($row->module != "GENERAL") {
                    $rightButton = "rightButton";
                }


                $button = [
                    'support' => $row->support,
                    'divparent' => $row->divparent,
                    'param' => $row->param,
                    'paramval' => $row->paramval,
                    'nextseparator' => $row->nextseparator,
                    'idselector' => $row->idselector,
                    'html' => '<' . $row->element . ' href="' . $row->href . '" id="' . $row->idselector . '" class="' . $row->class . ' btnhidden ' . $rightButton . ' ' . $classTooltip . '" ' . $messageTooltip . ' iconCls="' . $row->iconCls . '" plain="' . $row->plain . '" onclick="' . $row->onclick . '">' . $titlelang . '</' . $row->element . '> ',
                ];
                array_push($buttons, $button);
            }
        }
    }

    if ((count($buttons) == 0) and ( $module_name == 'GENERAL')) {
        header("location: ../login.php");
        exit;
    }
}

        
        
  

