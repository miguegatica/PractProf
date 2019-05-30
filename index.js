




function agregarTabTiposDocs(){
    
    var exist='Tipos Documento AFIP'; 
    
    
    if ($('#maintab').tabs('exists', exist)){ 
        //Si existe hace clic por el usuario sobre el tab seleccionadolo.
        $('#maintab').tabs('select',exist); 
    }else{
        //SI NO existe lo agrega...por eso llama a la funcion "add" = agregar.
            $('#maintab').tabs('add',{ 
                    id:'tiposDoc',
                    title:'Tipos Documento AFIP',  
                    closable:true,//Cerrable...
                    href: 'afip/tiposdoc_main.php' //Y esta es la URL que indica el contenido.
                    //Dicha URL si la colocamos en el navegador tiene que mostrar algo...
            });
            
    }
}



function agregarTabCliente(){
    
    var exist='Clientes'; 
    
    
    if ($('#maintab').tabs('exists', exist)){ 
        $('#maintab').tabs('select',exist); 
    }else{
        $('#maintab').tabs('add',{ 
                id:'Clientes',
                title:'Clientes',  
                closable:true,
                href: 'cliente/cliente_main.php' 
        });
            
    }
}


//
//function agregarTabLogin(){
//    
//    var exist='Login'; 
//    
//    
//    if ($('#maintab').tabs('exists', exist)){ 
//        $('#maintab').tabs('select',exist); 
//    }else{
//        $('#maintab').tabs('add',{ 
//                id:'Login',
//                title:'Login',  
//                closable:true,
//                href: 'superLogin/form.php' 
//        });
//            
//    }
//}














