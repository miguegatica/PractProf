
<?php


session_start();

$con2 = new PDO ('mysql:host=localhost;dbname=sistemas_3','root','');

$query2 = $con2->query('SELECT * FROM empresas');


if(isset($_POST['ingresar'])){
    $bd = $_POST['empresa'];//aca seleccione del select box el nombre de la base de datos  
//    echo $bd; 
    
    $_SESSION['empresa.db'] = $bd; 
    
    $nombreEmpresa = $con2->prepare('SELECT * FROM empresas WHERE bd =:nombre');
    $nombreEmpresa->bindParam(':nombre', $bd);
    $nombreEmpresa->execute(); 
    
    foreach ($nombreEmpresa as $datos) {
        $_SESSION['empresa.nombre'] = $datos['nombre'];//aca obtengo el nombre de la empresa
    }
    
    header('Location: ../index.php');
}
else{
    $_SESSION['empresa.db'] = ""; 
}



?>
    
<html>
<head>
	<meta charset="UTF-8">
	<title>Seleccionar empresas</title> 
        <link rel="stylesheet" href="../estilos/estilos.css">
       

</head>
    <body>
        <div>
            <form class="formulario" action="empresas.php" method="POST">
                <h1>Seleccionar empresa</h1> 
                <div class="contenedor">
                    <div class="input-contenedor">
                        <select name="empresa" class="contenedor">
                        <?php foreach ($query2 as $array){ ?>
                            <option value="<?php echo $array['bd']; ?>"><?php echo $array['nombre']; ?></option>    
                        <?php }?>
                        </select>
                    </div>
                <input type="submit" class="button" value="Ingresar" name="ingresar">
                </div>
            </form>          
        </div>
        
        <form class="formulario">
           
                 <a href="nuevaempresa.php"><input type="button" class="button" value="Nueva Empresa"></a>
 
            
        </form>
        
    </body>
</html>

