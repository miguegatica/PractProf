<?php

include_once('../lib/connections/conn.php');
include_once('../lib/utils.php');

        $idHie="";if(isset($_GET['idHie'])){$idHie=$_GET['idHie'];}
        $module="";if(isset($_GET['module'])){$module=$_GET['module'];}
        $selectorId="";if(isset($_GET['selectorId'])){$selectorId=$_GET['selectorId'];}
        $method="";if(isset($_GET['method'])){$method=$_GET['method'];}
        $nameHie="";if(isset($_GET['namehie'])){$nameHie=$_GET['namehie'];}
        //Arranco positivo...si falla aviso.
        $aReturn[]= array('result'=>true);
        switch ($method){
            case 'disabled':
                if (!disabledButton($idHie,$module,$selectorId)){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
            case 'enabled':
                if(!enabledButton($idHie,$module,$selectorId)){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
            
            case 'checkAllModule': //Activa a todos los perfiles para un modulo
                if(!switchButtonAllForModule($module,'1')){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
            case 'uncheckAllModule': //Activa a todos los perfiles para un modulo
                if(!switchButtonAllForModule($module,'0')){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
            case 'checkAllProfile': //Activa a todos los perfiles para un modulo
                if(!switchButtonAllForHieName($nameHie,$module,'1')){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
            case 'checkAllPermissions': //Activa a todos los modulos para un perfil
                if(!switchButtonAllPermissions($idHie,'1')){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
            case 'uncheckAllPermissions': //Activa a todos los modulos para un perfil
                if(!switchButtonAllPermissions($idHie,'0')){
                    $aReturn[]= array('result'=>false);
                    exit(json_encode($aReturn)); 
                }
                break;
        }
     
        
        exit(json_encode($aReturn)); 