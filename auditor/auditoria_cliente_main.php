<?php



?>

<!DOCTYPE html>
<html>
    <body>

        <table id="dgAuditoria" title="Operaciones sobre Cliente" class="easyui-datagrid" style="width:1500px;height:450px"
               url="auditor/auditoria_cliente_retrieve.php"
               toolbar="#toolbarAuditoria" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            
   
            <thead>
           
                <tr>
                    
                    <th field="id" width="50" hidden=true sortable="true">ID</th>
                    <th field="num_clienteOld" width="35" sortable="true" formatter="ColorRed">num_clienteOld</th>
                    <th field="apellidoOld" width="50" sortable="true" formatter="ColorRed">apellidoOld</th>
                    <th field="nombreOld" width="50" sortable="true" formatter="ColorRed">nombreOld</th>
                    <th field="nro_documentoOld" width="50" sortable="true" formatter="ColorRed">nro_documentoOld</th>
                    <th field="tipodocumento_idOld" width="50" sortable="true" formatter="ColorRed">tipodocumento_idOld</th>
                    <th field="num_clienteNew" width="50" sortable="true" formatter="ColorGreen">num_clienteNew</th> 
                    <th field="apellidoNew" width="50" sortable="true" formatter="ColorGreen">apellidoNew</th>
                    <th field="nombreNew" width="50" sortable="true" formatter="ColorGreen">nombreNew</th>
                    <th field="nro_documentoNew" width="50" sortable="true" formatter="ColorGreen">nro_documentoNew</th>
                    <th field="tipodocumento_idNew" width="50" sortable="true" formatter="ColorGreen">tipodocumento_idNew</th>
                    <th field="usuario" width="50" sortable="true">usuario</th>
                    <th field="accion" width="50" sortable="true" formatter="ColorBlue">accion</th>
                    <th field="modulo" width="50" sortable="true">modulo</th>
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


