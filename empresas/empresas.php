
<?php
session_start();

$con2 = new PDO ('mysql:host=localhost;dbname=sistemas_3','root','');

$query2 = $con2->query('SELECT * FROM empresas');

if(isset($_POST['ingresar'])){
    $bd = $_POST['empresa'];
//    echo $bd; 
    
    $_SESSION['empresa.db'] = $bd; 
    header('Location: ../index.php');
}



?>
    



<!<html>
    <head>
        <title>Seleccionar empresas</title>
    </head>
    <body>
        <div>
            <form action="empresas.php" method="POST">
                <select name="empresa">
                <?php foreach ($query2 as $array){ ?>
                    <option value="<?php echo $array['bd']; ?>"><?php echo $array['nombre']; ?></option>
                
                
                <?php }?>
                </select>   
                <input type="submit" value="Ingresar" name="ingresar">
            </form>              
            
        </div>
        
        <a href="nuevaempresa.php"><input type="button" value="Nueva Empresa"></a>
    </body>
</html>

