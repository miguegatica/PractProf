<?php



?>

<!DOCTYPE html>
<html>
    <body>
        <div style="margin:20px 0;">
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('imprimir/imprimir_customer.php', '_blank');">IMPRIMIR</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('excel/excel_customer.php', '_blank');">EXCEL</a>
            <a href="javascript:;" class="easyui-linkbutton" onclick="window.open('pdf/pdf_customer.php', '_blank');">PDF</a>
        </div>
        <table id="dgAuditoria" title="Operaciones sobre Cliente" class="easyui-datagrid" style="width:1500px;height:450px"
               url="auditor/auditoria_cliente_retrieve.php"
               toolbar="#toolbarAuditoria" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            
   
            <thead>
           
                <tr>
                    
                    <th field="id" width="50" hidden=true sortable="true">ID</th>
                    <th field="num_clienteOld" width="35" sortable="true" formatter="ColorRed">NumCliente</th>
                    <th field="apellidoOld" width="50" sortable="true" formatter="ColorRed">Apellido</th>
                    <th field="nombreOld" width="50" sortable="true" formatter="ColorRed">Nombre</th>
                    <th field="nro_documentoOld" width="50" sortable="true" formatter="ColorRed">NroDoc</th>
                    <th field="tipodocumento_idOld" width="50" sortable="true" formatter="ColorRed">TipoDoc</th>
                    <th field="num_clienteNew" width="50" sortable="true" formatter="ColorGreen">NumCliente</th> 
                    <th field="apellidoNew" width="50" sortable="true" formatter="ColorGreen">Apellido</th>
                    <th field="nombreNew" width="50" sortable="true" formatter="ColorGreen">Nombre</th>
                    <th field="nro_documentoNew" width="50" sortable="true" formatter="ColorGreen">NroDoc</th>
                    <th field="tipodocumento_idNew" width="50" sortable="true" formatter="ColorGreen">TipoDoc</th>
                    <th field="usuario" width="50" sortable="true">Usuario</th>
                    <th field="accion" width="50" sortable="true" formatter="ColorBlue">Acción</th>
                    <!--<th field="modulo" width="50" sortable="true">Modulo</th>-->
                    <th field="fecha" width="50" sortable="true">Fecha</th>
                    <th field="hora" width="50" sortable="true">Hora</th>
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


