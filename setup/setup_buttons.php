<?php
include_once(dirname(__FILE__).'/../login/loginok.php');
include_once(dirname(__FILE__).'/../lib/connections/conn.php');
include_once(dirname(__FILE__).'/../lib/utils.php');

//Creo todos los permisos por si se creo un nuevo hie o un nuevo modulo
createAllPerms();
require_once('../lang.php');
$tr = $lang['es_LAT'];



$OperatorHIE = $_SESSION['operator_profile'];
?>


<style>
    .disabledInput {
        color: black !important;
    }
    
    input[type=checkbox] {
  /* All browsers except webkit*/
  transform: scale(1.5);

  /* Webkit browsers*/
  -webkit-transform: scale(1.5);
}


</style>


<script type="text/javascript">
    var tr = <?php echo json_encode($tr); ?>;

</script
<div id="logo" style="margin-top: 10px;">  
    <div id="viewsOperators" style="padding-top: 5px; width: 800px; margin: 0 auto;text-align: center;">

        <?php echo $tr['Select'] . ' ' . $tr['Module'] ?><br><br>
        <input id="ccOpModulesPerms" class="easyui-combobox"  style="width:380px;" name="ccOpModulesPerms" ><br>  

    </div>
    <br>
    <br>
    <div id="cc" class="easyui-layout" style="width:100%;height:70%;">       
        <div id="toolHies">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="checkAll()"><?php echo $tr['Check All']; ?></a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="uncheckAll()"><?php echo $tr['Uncheck All']; ?></a>
        </div>
        <div data-options="region:'center',title:'<?php echo $tr['Setup Permissions']?>'" style="padding:5px;background:#eee;">
            <table id="dgHieButtons"  style="width:auto;height:400px">

            </table>
        </div>
    </div>
    

</div>

<script type="text/javascript" src="setup/setup_buttons.js?v=ddddd44dddd3"></script> 

