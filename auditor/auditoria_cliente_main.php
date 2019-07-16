<?php



?>

<!DOCTYPE html>
<html>
    <body>
<!--        <script type="text/javascript">
            url="auditor/auditoria_cliente_retrieve.php" 
        </script>-->
        <div style="margin:20px 0;">
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('imprimir/imprimir_customer.php', '_blank');">IMPRIMIR</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('excel/excel_customer.php', '_blank');">EXCEL</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('pdf/pdf_customer.php', '_blank');">PDF</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="reloadAudClient();">ACTUALIZAR AUDITORIA</a>
        </div>
        <table id="dgAuditoriaClient" title="Operaciones sobre Cliente" class="easyui-datagrid" style="width:1200px;height:450px"   
               url="auditor/auditoria_cliente_retrieve.php" 
               toolbar="#toolbarAuditoria" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
           
                <tr>
                    <th field="id" width="15" hidden=true sortable="true">ID</th>
                    <th field="fecha" width="15" sortable="true">FECHA</th>
                    <th field="usuario" width="15" sortable="true">USUARIO</th>  
                    <th field="accion" width="15" sortable="true">ACCIÓN</th>
                    <th field="hora" width="15" sortable="true">HORA</th>  
                    <th field="num_cliente" width="15" sortable="true" formatter="Style">NumCliente</th> 
                    <th field="apellido" width="15" sortable="true" formatter="Style">Apellido</th>
                    <th field="nombre" width="15" sortable="true" formatter="Style">Nombre</th>
                    <th field="nro_documento" width="15" sortable="true" formatter="Style">NroDoc</th>
                    <th field="tipodocumento_id" width="15" sortable="true" formatter="Style">TipoDoc</th>
                        
                </tr> 
            </thead>
        </table>


    <script type="text/javascript">
        
        function reloadAudClient() {
            $('#dgAuditoriaClient').datagrid('reload');    // reload the cliente data
            }  

        function Style(val,row){

                    return '<span style="font-weight: bold;">'+val+'</span>';
        }
    </script>

  
    </body>
</html>

