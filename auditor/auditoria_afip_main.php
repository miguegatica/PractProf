<?php



?>

<!DOCTYPE html>
<html>
    <body>
        <div style="margin:20px 0;">
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('imprimir/imprimir_afip.php', '_blank');">IMPRIMIR</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('excel/excel_afip.php', '_blank');">EXCEL</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('pdf/pdf_afip.php', '_blank');">PDF</a>
        </div>
        <table id="dgAuditoria" title="Operaciones sobre Cliente" class="easyui-datagrid" style="width:1500px;height:450px"
               url="auditor/auditoria_afip_retrieve.php"
               toolbar="#toolbarAuditoria" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            
   
            <thead>
             <tr>
                <th field="id" width="50" hidden=true sortable="true">ID</th>
                    <th field="nro_afipOld" width="35" sortable="true" formatter="ColorRed">NroAfip</th>
                    <th field="descripcionOld" width="50" sortable="true" formatter="ColorRed">Descripción</th>
                    <th field="siglaOld" width="50" sortable="true" formatter="ColorRed">Sigla</th>
                    <th field="nro_afipNew" width="50" sortable="true" formatter="ColorGreen">NroAfip</th>
                    <th field="descripcionNew" width="50" sortable="true" formatter="ColorGreen">Descripción</th>
                    <th field="siglaNew" width="50" sortable="true" formatter="ColorGreen">Sigla</th> 
                    <th field="usuario" width="50" sortable="true">Usuario</th>
                    <th field="accion" width="50" sortable="true" formatter="ColorBlue">Acción</th>
                    <!--<th field="modulo" width="50" sortable="true">modulo</th>-->
                    <th field="fecha" width="50" sortable="true">fecha</th>
                    <th field="hora" width="50" sortable="true">hora</th>
                </tr> 
            </thead>
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
              

    </script>
         
   
    </body>
</html>


