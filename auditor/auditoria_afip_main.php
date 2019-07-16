<?php



?>

<!DOCTYPE html>
<html>
    <body>
        <div style="margin:20px 0;">
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('imprimir/imprimir_afip.php', '_blank');">IMPRIMIR</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('excel/excel_afip.php', '_blank');">EXCEL</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('pdf/pdf_afip.php', '_blank');">PDF</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="reloadAudAfip();">ACTUALIZAR AUDITORIA</a>
        </div>
        <table id="dgAuditoriaAfip" title="Operaciones sobre Afip" class="easyui-datagrid" style="width:1200px;height:450px"
               url="auditor/auditoria_afip_retrieve.php"
               toolbar="#toolbarAuditoria" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            
   
            <thead>
             <tr>
                <th field="id" width="15" hidden=true sortable="true">ID</th>
                    <th field="fecha" width="15" sortable="true">FECHA</th>
                    <th field="usuario" width="15" sortable="true">USUARIO</th>  
                    <th field="accion" width="15" sortable="true">ACCIÓN</th>     
                    <th field="hora" width="15" sortable="true">HORA</th>
                    <th field="nro_afip" width="10" sortable="true" formatter="Style">NroAfip</th>
                    <th field="descripcion" width="20" sortable="true" formatter="Style">Descripción</th>
                    <th field="sigla" width="15" sortable="true" formatter="Style">Sigla</th>              
                </tr> 
            </thead>
        </table>
        
        
    <script type="text/javascript">
        
        function reloadAudAfip() {
            $('#dgAuditoriaAfip').datagrid('reload');    // reload the cliente data
            }  
            
        function Style(val,row){

                    return '<span style="font-weight: bold;">'+val+'</span>';
        }
    </script>      
   
    </body>
</html>


