
<?php


function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}


function json_response($message = null, $code = 200)
{
    // clear the old headers  ----- borrar los encabezados antiguos 
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced ----- establece el encabezado para asegurarse de que el caché está forzado 
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json -------- trata esto como json 
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request', //Solicitud incorrecta
        422 => 'Unprocessable Entity',//Entidad no procesable
        500 => '500 Internal Server Error'//error de servidor interno
        );
    // ok, validation error, or failure -------- ok, error de validación, o falla 
    header('Status: '.$status[$code]);
    // return the encoded json   ----------- devuelve el json codificado 
    return json_encode(array(
        'status' => $code < 300, // si el error es menor a 300 va a ponerlo en "true" (no hubo un error http)
        'errorMsg' => $message   // ..., sino va a mostrar este mensaje 
        ));
}



  function actualizarAudClientes() {        
  "<script>
      url='auditor/auditoria_cliente_retrieve.php';

</script>";     
 
}

    
//***************** AFIP ACTULIZAR ***************************** //


function datosafip ($id){

$conn = null;
    if (crearConexion($conn)){
        $query = "Select nro_afip, descripcion, sigla from tipodocumento where id = '$id'";
        $result = $conn->query($query);
        $resultObj = $result->fetch_object();
        
        $_SESSION['nro_afip']= $resultObj->nro_afip;
        $_SESSION['descripcion']= $resultObj->descripcion;
        $_SESSION['sigla']= $resultObj->sigla;
    
        $conn->close();

    } 
}



//************* CLIENTE ACTUALIZAR **************************

function datoscustormer ($id){
$conn = null;
    if (crearConexion($conn)){
        $query = "Select num_cliente, apellido, nombre, nro_documento, tipodocumento_id  from cliente where id = '$id'";
        $result = $conn->query($query);
        $resultObj = $result->fetch_object();
        
        $_SESSION['num_cliente']= $resultObj->num_cliente;
        $_SESSION['apellido']= $resultObj->apellido;
        $_SESSION['nombre']= $resultObj->nombre;
        $_SESSION['nro_documento']= $resultObj->nro_documento;
        $_SESSION['tipodocumento_id']= $resultObj->tipodocumento_id;
    
        $conn->close();

    }    
}




//************** INSERT INTO afipauditoria ****************** //

function insert_auditoriaDoc($movement){
    if(session_status() == PHP_SESSION_NONE){
        session_start();     
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $date=date("Y-m-d");
    $time=date("H:i:s");   
      
    $userPost = $_SESSION['usuario'];


    $conn = null;
    if (crearConexion($conn)){
    
        $nro_afip = $_SESSION['nro_afip'];
        $descripcion = $_SESSION['descripcion'];
        $sigla = $_SESSION['sigla'];

        $queryAuditor = "INSERT INTO afipauditoria (nro_afip, descripcion, sigla, usuario, accion, fecha, hora) VALUES ('$nro_afip', '$descripcion', '$sigla', '$userPost', '$movement', '$date', '$time')";

        
        $conn->query($queryAuditor);

        $conn->close();

    }
   
}
    




//************** INSERT INTO clienteauditoria ****************** //

function insert_auditoriaCustomer($movement){
    if(session_status() == PHP_SESSION_NONE){
        session_start(); 
//        ob_start();    
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $date=date("Y-m-d");
    $time=date("H:i:s");   
      
    $userPost = $_SESSION['usuario'];
    
    
//    $ip = $_SERVER["REMOTE_ADDR"];

    $conn = null;
    if (crearConexion($conn)){

        $num_cliente =  $_SESSION['num_cliente']; 
        $apellido = $_SESSION['apellido'];
        $nombre = $_SESSION['nombre'];
        $nro_documento = $_SESSION['nro_documento'];
        $tipodocumento_id = $_SESSION['tipodocumento_id'];                


        $queryAuditor = "INSERT INTO clienteauditoria (num_cliente, apellido, nombre, nro_documento, tipodocumento_id, usuario, accion, fecha, hora) VALUES ('$num_cliente', '$apellido', '$nombre', '$nro_documento', '$tipodocumento_id', '$userPost', '$movement', '$date', '$time')";

        $conn->query($queryAuditor);

        $conn->close();

    }
   
}






function verSiHayClientes($id){
$conn = null;
    if (crearConexion($conn)){   
    $query = "Select * from cliente where cliente.tipodocumento_id = '$id'";

    $result = $conn->query($query);
    
    $cantidad = $result->num_rows; 
        
    return $cantidad; 

    }
    
    $conn->close();
   
}




function devolverIdAfip($nro_afip){
$conn = null;
    if (crearConexion($conn)){   
    $query = "Select id from tipodocumento where tipodocumento.nro_afip = '$nro_afip'";

    $result = $conn->query($query);
    
    $resultObj = $result->fetch_object();
    
     $id = $resultObj->id; 
        
    return $id; 

    }
    
    $conn->close();
   
}


function devolverIdCustomer($num_cliente){
$conn = null;
    if (crearConexion($conn)){   
    $query = "Select id from cliente where cliente.num_cliente = '$num_cliente'";

    $result = $conn->query($query);
    
    $resultObj = $result->fetch_object();
    
    $id = $resultObj->id; 
        
    return $id; 

    }
    
    $conn->close();
   
}














       
/*PERMISOS ! ******************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
/* LA SIGUIENTE FUNCION CREA LOS BOTONES POR OPERADOR DEPENDIENDO EL MODULO,
  LO UNICO QUE TENDRIA QUE ASEGURARME ES INDICAR EN GENERAL_COLUMNS LAS COLUMNAS QUE DESEO QUE SE CREEN.
  SE PUEDE LLAMAR CUANTAS VECES QUIERA TOTAL NO DUPLICA COLUMNAS. */
////////////////////////////////////////////////////////////////////////////
function createButtonsOp($idop, $module) {

    $db = null;
    if (crearConexion($db)){
        $query = "insert into operator_button (`operatorid`,`buttonid`,`module`,`idselector`,`href`,`class`,`iconCls`,`plain`,`onclick`,`title`,`style`,`ordernum`,`locked`,`support`)
                (select 
                '$idop' as operatorid,
                CONCAT(id) as buttonid,
                `module`,`idselector`,`href`,`class`,`iconCls`,`plain`,`onclick`,`title`,`style`,`ordernum`,`locked`,`support`
                from permisos
                where permisos.module='$module' ORDER BY id) ON DUPLICATE KEY UPDATE module='$module' ";

        $db->query($query);

        $db->close();
    }
    
}

function disabledButton($perfilusuario, $module, $selectorId) {
    $query = "UPDATE permisos_perfiles
    SET permisos_perfiles.can='0'
    WHERE permisos_perfiles.perfil_id='$perfilusuario' 
    AND permisos_perfiles.permiso_id = (SELECT permisos.id FROM permisos WHERE permisos.idselector='$selectorId' AND permisos.module='$module' )";

    $db = null;
    if (crearConexion($db)){
        if (!$db->query($query)) {
            $db->close();
            return false;
        }
        $db->close();
        return true;
    }

    
}

function enabledButton($perfilusuario, $module, $selectorId) {
    $query = "UPDATE permisos_perfiles
    SET permisos_perfiles.can='1'
    WHERE permisos_perfiles.perfil_id='$perfilusuario' 
    AND permisos_perfiles.permiso_id = (SELECT permisos.id FROM permisos WHERE permisos.idselector='$selectorId' AND permisos.module='$module' )";

    $db = null;
    if (crearConexion($db)){
        if (!$db->query($query)) {
            $db->close();
            return false;
        }
        $db->close();
        return true;
    }

    
}

function switchButtonAllForModule($module, $can) {
    $query = "UPDATE permisos_perfiles
                SET permisos_perfiles.can='$can'
                WHERE permisos_perfiles.permiso_id in (SELECT permisos.id FROM permisos WHERE  permisos.module='$module' )";

    $db = null;
    if (crearConexion($db)){
        if (!$db->query($query)) {
            $db->close();
            return false;
        }
        $db->close();
        return true;
        
    }
    
}

function switchButtonAllPermissions($hieId, $can) {

    $db = null;
    if (crearConexion($db)){
        $query = "UPDATE permisos_perfiles
                    SET permisos_perfiles.can='$can'
                    WHERE permisos_perfiles.perfil_id = '$perfilusuarioId' ";

        if (!$db->query($query)) {
            $db->close();
            return false;
        }
        $db->close();
        return true;
    }



    
}

function switchButtonAllForHieName($perfilusuarioName, $module, $can) {

    $queryCant = "SELECT SUM(permisos_perfiles.can) cant
                    FROM permisos_perfiles
                    WHERE permisos_perfiles.perfil_id in (select perfilusuario.id from perfilusuario where perfilusuario.perfil='$perfilusuarioName')  and permisos_perfiles.permiso_id in (SELECT permisos.id FROM permisos WHERE  permisos.module='$module' )";


    $db = null;
    if (crearConexion($db)){
        $cant = $db->query($queryCant)->fetch_object()->cant;

        if (empty($cant)) {
            $can = '1';
        } else {
            $can = '0';
        }

        $query = "UPDATE permisos_perfiles
                    SET permisos_perfiles.can='$can'
                    WHERE permisos_perfiles.perfil_id in (select perfilusuario.id from perfilusuario where perfilusuario.perfil='$perfilusuarioName')  and permisos_perfiles.permiso_id in (SELECT permisos.id FROM permisos WHERE  permisos.module='$module' )";


        if (!$db->query($query)) {
            $db->close();
            return false;
        }
        $db->close();
        return true;
    }

    
}

//Crea la realacion entre el permiso y el perfil. Por ejemplo Clientes.CrearNuevo -- Director -- SI
//En un principio los crea a todos los perfiles en si.
function createGeneralButtonsHie(&$db, $perfilusuario, $module) {

    $typeSuperAdmin = $db->query(" SELECT parameter FROM params WHERE params.name = 'perfilusuario_superadmin' ")->fetch_object()->parameter;
    $can = "0";
    
    //El auditor SIEMPRE puede hacer todo
    if ($typeSuperAdmin == $perfilusuario) {
        $can = "1";
    }

    $query = "insert into permisos_perfiles (`permiso_id`,`perfil_id`,`can`)
            (select 
            CONCAT(id) as permiso_id,
            '$perfilusuario' as perfil_id,
            '$can' as can
            from permisos
            where permisos.module='$module' ORDER BY id) ON DUPLICATE KEY UPDATE perfil_id='$perfilusuario' ";

    $db->query($query);
}

//Genera el boton para el permiso pero en modo PERMITIDO...ES DECIR CAN EN TRUE
function createGeneralButtonsHieActive(&$db, $perfilusuario, $module) {

    $can = "1";

    $query = "insert into permisos_perfiles (`permiso_id`,`perfil_id`,`can`)
            (select 
            CONCAT(id) as permiso_id,
            '$perfilusuario' as perfil_id,
            '$can' as can
            from permisos
            where permisos.module='$module' ORDER BY id) ON DUPLICATE KEY UPDATE perfil_id='$perfilusuario' ";

    $db->query($query);
}

//LO NUEVO PARA EL TRABAJO CON PERMISOS
//POR AHORA SOLO LO ENCARAREMOS CON LOS BOTONES...MAS ADELANTE POR SEGURIDAD DEBERIAMOS NOO CREAR LAS VENTANAS.
//Si queremos que algun boton solo se ejecute dado determinado parametro es necesario dejarlo acentado
//Si queremos que a continuacion dibuje un div divisor indicar separator en true.
//Element me dice si es un <div> o un <a>
function createRowsGeneralButtons(&$db, $module, $idselector, $title, $onclick = "", $iconCls = "", $class = "", $divparent = "", $element = "", $nextseparator = "", $param = "", $paramval = "", $support = "false", $href = "#", $plain = "true", $style = "", $body = "0", $tooltip = "false", $messagetool = "", $activate_for_all = false) {
    set_time_limit(0);
    //$support me dice si es solo para soporte.
    $locked = "false";
    $ordernum = 0;

    //Consulto cual es el proximo ordernum para este modulo, sino existe le doy 0.
    $queryLastOrderNum = " select ordernum from permisos where module='$module' ORDER BY ordernum DESC LIMIT 1 ";


    if ($lastOrderNum = $db->query($queryLastOrderNum)->fetch_object()) {
        $ordernum = intval($lastOrderNum->ordernum) + 1;
    }


    $queryInsert = "INSERT INTO `permisos` (  `module`,`title`, `onclick`, `href`, `iconCls`, `idselector`, `class`, `plain`,`style`,`locked`,`ordernum`,`support`,`divparent`,`param`,`paramval`,`nextseparator`,`element`,`body`,`tooltip`,`messagetool`) VALUES "
            . "( '$module', '$title', '$onclick', '$href', '$iconCls', '$idselector', '$class', '$plain', '$style','$locked','$ordernum','$support','$divparent','$param','$paramval','$nextseparator','$element','$body','$tooltip','$messagetool')";
    $db->query($queryInsert);


    if (!$result12 = $db->query(" SELECT perfilusuario.id from perfilusuario ")) {
        die('There was an error running the query [' . $db->error . ']');
    }

    while ($row = $result12->fetch_object()) {
        $perfilusuario = $row->id;

        if(!$activate_for_all){
            //El permiso NO se crea activado para todos
            createGeneralButtonsHie($db, $perfilusuario, $module);
        }else{
            //Significa que fue creado para que todos lo tengan activo al permiso.
            createGeneralButtonsHieActive($db, $perfilusuario, $module);
        }
        
    }
    set_time_limit(30);
    return true;
}

//Actualiza todos los permisos cada vez que se cree un nuevo modulo o un nuevo perfil
function createAllPerms() {

    //Obtengo todos los modulos

    $db = null;
    if (crearConexion($db)){
        if ($result1 = $db->query(" select module from permisos GROUP BY module ")) {
            while ($row1 = $result1->fetch_object()) {
                $module = $row1->module;

                if ($result2 = $db->query(" SELECT perfilusuario.id from perfilusuario ")) {
                    while ($row2 = $result2->fetch_object()) {
                        $perfilusuario = $row2->id;


                        $query = "insert into permisos_perfiles (`permiso_id`,`perfil_id`)
                                        (select 
                                        CONCAT(id) as permiso_id,
                                        '$perfilusuario' as perfil_id
                                        from permisos
                                        where permisos.module='$module' ORDER BY id) ON DUPLICATE KEY UPDATE perfil_id='$perfilusuario' ";



                        $db->query($query);
                    }
                } else {
                    logger($db->error);
                }
            }
        } else {
            print_r($db->error);
        }
        $db->close();
    }
    
    
    return true;
}

function canAcctionButton($idselector, $idperfilusuario) {
//Dice SI o NO un perfil puede ejecutar una accion
    if ($idperfilusuario == '99') {
        return true;
    }
    $query = "select can 
            from permisos_perfiles
            where permisos_perfiles.permiso_id in 
            (select id from permisos where idselector = '$idselector') 
            and permisos_perfiles.perfil_id = '$idperfilusuario' ";

    //Obtengo todos los modulos
    $db = null;
    if (crearConexion($db)){
        //loggerDBFisrsLine($db,"$query");
        $rta1 = $db->query($query);
        $rta = '0';
        if ($rta1->num_rows == 0) {
            return false;
        } else {
            $rta = $rta1->fetch_object()->can;
        }
        $db->close();

        if (empty($rta)) {
            return false;
        }
        return true;

    }
    
}

function canAcctionButtonDB(&$db, $idselector, $idperfilusuario) {
//Dice SI o NO un perfil puede ejecutar una accion con una conexion abierta...es para no abrir y cerrar la conexion a cada rato
    if ($idperfilusuario == '99') {
        return true;
    }
    $query = "select can 
            from permisos_perfiles
            where permisos_perfiles.permiso_id in 
            (select id from permisos where idselector = '$idselector') 
            and permisos_perfiles.perfil_id = '$idperfilusuario' ";


    //Obtengo todos los modulos
    $db = null;
    if (crearConexion($db)){
        $rta = $db->query($query)->fetch_object()->can;

        $db->close();

        if (empty($rta)) {
            return false;
        }
        return true;
    }
    
}

/*FIN PERMISOS! ***************************************************************/


function checkparameterlogin(&$db, $param, $data) {
    $query = "SELECT parameter FROM params WHERE params.name='$param' ";
    $result = $db->query($query);

    $row = $result->num_rows;
    if ($row === 0) {
        //creo el parametro
        $query2 = "INSERT INTO params ( name, parameter) VALUES  ('$param','$data')";
        $db->query($query2);
    }

    $result->close();
}