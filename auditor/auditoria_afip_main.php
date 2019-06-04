<?php



?>

<!DOCTYPE html>
<html>
    <body>

        <table id="dgAuditoria" title="Operaciones sobre Cliente" class="easyui-datagrid" style="width:1500px;height:450px"
               url="auditor/auditoria_afip_retrieve.php"
               toolbar="#toolbarAuditoria" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            
   
            <thead>
             <tr>
                <th field="id" width="50" hidden=true sortable="true">ID</th>
                    <th field="nro_afipOld" width="35" sortable="true" formatter="ColorRed">nro_afipOld</th>
                    <th field="descripcionOld" width="50" sortable="true" formatter="ColorRed">descripcionOld</th>
                    <th field="siglaOld" width="50" sortable="true" formatter="ColorRed">siglaOld</th>
                    <th field="nro_afipNew" width="50" sortable="true" formatter="ColorGreen">nro_afipNew</th>
                    <th field="descripcionNew" width="50" sortable="true" formatter="ColorGreen">descripcionNew</th>
                    <th field="siglaNew" width="50" sortable="true" formatter="ColorGreen">siglaNew</th> 
                    <th field="usuario" width="50" sortable="true">usuario</th>
                    <th field="accion" width="50" sortable="true" formatter="ColorBlue">accion</th>
                    <th field="modulo" width="50" sortable="true">modulo</th>
                    <th field="fecha" width="50" sortable="true">fecha</th>
                    <th field="hora" width="50" sortable="true">hora</th>
                </tr> 
            </thead>
            <br>
             <div id="tb" style="padding:3px">
                <span>Accion:</span>
                <input id="accion" style="line-height:26px;border:1px solid #ccc">
      
                <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
                </div>
             <br>
        </table>
        
       

        
        <script type="text/javascript">  
                function ColorRed(val,row){
                    
                        return '<span style="color:red;">'+val+'</span>';
                    
                }
                
                function ColorGreen(val,row){
                    
                        return '<span style="color:green;">'+val+'</span>';
                    
                }
                
                function ColorBlue(val,row){
                    
                        return '<span style="color:blue;">'+val+'</span>';
                    
                }
                
                
                
//          ****************************  FILTRO ********************************************      
                
     function doSearch(){
    $('#dgAuditoria').datagrid('load',{
        accion: $('#accion').val(),
       
        });
    }
     
    </script>
         
   
    </body>
</html>


