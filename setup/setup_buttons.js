
var datayesno = [{label:tr['Yes'],value:'true'},{label:tr['No'],value:'false'}];
var datarigthleft = [{label:tr['Right'],value:'right'},{label:tr['Left'],value:'left'}];

function formaterTrueFalse(value,row,index){
    if (value == 'true'){
        return tr['Yes'];
    } else {
       return tr['No'];
    }
}
function formaterRightLeft(value,row,index){
    if (value == 'right'){
        return tr['Right'];
    } else {
       return tr['Left'];
    }
}
function formaterColumTitle(value,row,index){
    var trans = tr[value];
    if (typeof trans !== "undefined") {
        return trans;
    }
    return value;
}

$('#ccOpModulesPerms').combobox({
    panelHeight: 'auto',
    selectOnNavigation: false,
    valueField: 'value',
    textField: 'label',
    editable: false,
    data:datamodulesperms,//ESTA VARIABLE ESTA EN MAIN_PROC.JS PORQUE LA UTILIZO SIEMPRE.
    onChange: function(newVal,oldVal){changeOpModule(newVal);},
});

function changeOpModule(newVal){
    //Deberia recargar la tabla con los datos correspondientes!
    
    rechargeHiePermsGrid(newVal);
    //$('#dgHieButtons').datagrid('reload');
}

function updatedOk(){
    $.messager.show({
        title:tr['Updated'],
        msg:'<div style="text-align:center"><h4>'+tr['Updated']+' Ok!</h4></div>',
        showType:'show',
        timeout:2000,
        //showType:'show'
    });
}

function disabledButton(idHie,module,selectorId){
    $.messager.progress();
   
    $.ajax({
        type: "GET",
        url: 'setup/buttons_utils.php?idHie='+idHie+'&module='+module+'&selectorId='+selectorId+'&method=disabled',
        async:false,
        success: function(datos){
            var data = eval('('+datos+')');
            if(data[0]['result']!=true){
                $.messager.alert("ERROR" , 'Error' ,'warning');    
                return false;
            }
            $('#dgHieButtons').datagrid('reload');
            $.messager.progress('close');
            updatedOk();
        }

    });
}

function enabledButton(idHie,module,selectorId){
    $.messager.progress();
    $.ajax({
        type: "GET",
        url: 'setup/buttons_utils.php?idHie='+idHie+'&module='+module+'&selectorId='+selectorId+'&method=enabled',
        async:false,
        success: function(datos){
            var data = eval('('+datos+')');
            if(data[0]['result']!=true){
                $.messager.alert("ERROR" , 'Error' ,'warning');    
                return false;
            }
            $('#dgHieButtons').datagrid('reload');
            $.messager.progress('close');
            updatedOk();
        }

    });
}


function myformatterChecked(value,row,index){
    var arr = value.split(";");
    var can = arr[0];
    var idHie = arr[1];
    var selectorId = arr[2];
    var module = arr[3];
    //console.log("Can "+can+" idHie "+idHie+" selectorId "+selectorId+" module "+module);
    if (can == '1'){
        //enabledButton($idHie,$module,$selectorId)
        return '<input type="checkbox" checked onchange=\'disabledButton("'+idHie+'","'+module+'","'+selectorId+'")\' >';
    } else {
       return '<input type="checkbox" onchange=\'enabledButton("'+idHie+'","'+module+'","'+selectorId+'")\' >';
    }
}

function cSAction(value,row,index){
    var cReturn="background-color:gray;font-weight: bold;color:white;font-size:15px;";
    return cReturn;
}
function rechargeHiePermsGrid(module){

    $.ajax({
    type: "GET",
    url: 'setup/buttons_retrieve.php?type='+module,
    success: function(datos){

        data = eval('('+datos+')');
        var arr = [];
        var colstruct = [];
        var json = data.fields;
        var parsed = JSON.parse(json);
        var obj = "";
        for(var x in parsed){
            //Subtitulado arr.push({field:parsed[x]['field'], title:tr[parsed[x]['title']],width:'150'});
            if (parsed[x]['field'] != 'title'){
                arr.push({field:parsed[x]['field'], title:parsed[x]['title'],width:'100',formatter:myformatterChecked,align:'center'});
            }else{
                arr.push({field:parsed[x]['field'], title:tr['Action'],width:'400',styler:cSAction});
            }
        }

        colstruct.push(arr);


        if(data.rta===true){
            $('#dgHieButtons').datagrid({
                columns:colstruct,
                data:data.rows,
                singleSelect:true,
                toolbar: '#toolHies',
            });
            
            $('#dgHieButtons').datagrid('getPanel').find('div.datagrid-header td').attr('ondblclick','checkedProfileAll(this)');
            return true;
        }

    }
    }); 
}


function checkedProfileAll(e){

    var profile = $(e).find('span').text().trim();
    var module = $('#ccOpModulesPerms').combobox('getValue');
    $.messager.progress();
 

    $.ajax({
        type: "GET",
        url: 'setup/buttons_utils.php?method=checkAllProfile&namehie='+profile+'&module='+module,
        async:true,
        success: function(datos){
            var data = eval('('+datos+')');
            if(data[0]['result']!=true){
                $.messager.alert("ERROR" , 'Error' ,'warning');    
                return false;
            }
            rechargeHiePermsGrid(module);
            $('#dgHieButtons').datagrid('reload');
            $.messager.progress('close');
            updatedOk();
        }

    });
}

function checkAll(){
    $.messager.progress();
    var module = $('#ccOpModulesPerms').combobox('getValue');

    $.ajax({
        type: "GET",
        url: 'setup/buttons_utils.php?module='+module+'&method=checkAllModule',
        async:true,
        success: function(datos){
            var data = eval('('+datos+')');
            if(data[0]['result']!=true){
                $.messager.alert("ERROR" , 'Error' ,'warning');    
                return false;
            }
            rechargeHiePermsGrid(module);
            $('#dgHieButtons').datagrid('reload');
            $.messager.progress('close');
            updatedOk();
        }

    });
}

function uncheckAll(){
    $.messager.progress();
    var module = $('#ccOpModulesPerms').combobox('getValue');

    $.ajax({
        type: "GET",
        url: 'setup/buttons_utils.php?module='+module+'&method=uncheckAllModule',
        async:true,
        success: function(datos){
            var data = eval('('+datos+')');
            if(data[0]['result']!=true){
                $.messager.alert("ERROR" , 'Error' ,'warning');    
                return false;
            }
            rechargeHiePermsGrid(module);
            $('#dgHieButtons').datagrid('reload');
            $.messager.progress('close');
            updatedOk();
        }

    });
}

function updateActionsAcctCustomersView(index){
    $('#ccOpModulesPerms').datagrid('updateRow',{
        index: index,
        row:{}
    });
}
function editrowAcctCustomerView(target){
    $('#ccOpModulesPerms').datagrid('beginEdit',getRowIndex(target));
}
function saverowAcctCustomerView(target){
    $('#ccOpModulesPerms').datagrid('endEdit', getRowIndex(target));
    $('#ccOpModulesPerms').datagrid('reload');

}
function cancelrowAcctCustomerView(){
    $('#ccOpModulesPerms').datagrid('reload');
    
}
function getRowIndex(target){
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}

//////////////////// FIN CUSTOMERS /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
