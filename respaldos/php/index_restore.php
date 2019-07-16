<?php
session_start();



if (isset($_POST['restore'])) {



    $nombreEmpresa = $_SESSION['empresa.nombre'];

    $nombreBD = $_SESSION['empresa.db'];

    $contrasenia = $_POST['contrasenia'];

    //$company_backup = $_POST['company_backup'];
    //SI contrasenia es igual a la que tiene la empresa en SESSION ....

    $conn = new PDO('mysql:host=localhost;dbname=sistemas_3', 'root', '');

    $statement = $conn->prepare('SELECT count(*) FROM empresas WHERE (nombre =:nombre) and (contrasenia=:contrasenia) ');
    $statement->bindParam(':nombre', $nombreEmpresa);
    $statement->bindParam(':contrasenia', $contrasenia);
    $statement->execute();

    $result = $statement->fetch();

    $count = $result[0];


    if ($count == 0) {
        echo "<script>
                            alert('Contraseña no válida. Verifique su contraseña.');
                            window.location= '../php/index_backup.php'
                        </script>";
    } else {


        $companyname = $_SESSION['empresa.nombre'];
        $bd_name = trim($nombreEmpresa);
        $bd_name = str_replace(' ', '', $bd_name);
        $bd_name = str_replace('/', '', $bd_name);
        $bd_name = str_replace('.', '', $bd_name);
        $fileTmpPath = $_FILES['company_backup']['tmp_name'];
        $fileName = $_FILES['company_backup']['name'];
        $fileSize = $_FILES['company_backup']['size'];
        $fileType = $_FILES['company_backup']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = $_FILES["company_backup"]["name"];
        //$uploadFileDir = '/respaldos/clientes/';

        $uploadFileDir = dirname(__FILE__) . '/../clientes/' . $_SESSION['empresa.db'] . '/upload';
        //$fileName = $date."...".$time.".sql";
        if (!is_dir($uploadFileDir)) {
            if (!mkdir($uploadFileDir, 0777, true)) {
                die("No se pudo crear el directorio!" . PHP_EOL);
            }
        }

        $dest_path = $uploadFileDir . "/" . $newFileName;
        move_uploaded_file($fileTmpPath, $dest_path);



        ////////////////////////////////////////////////////////////////////////

        $nombreEmpresa = $_SESSION['empresa.nombre'];

        $nombreBD = $_SESSION['empresa.db'];

        $contrasenia = $_POST['contrasenia'];

        //$company_backup = $_POST['company_backup'];



//SI contrasenia es igual a la que tiene la empresa en SESSION ....

        $conn = new PDO('mysql:host=localhost;dbname=sistemas_3', 'root', '');

        $statement = $conn->prepare('SELECT count(*) FROM empresas WHERE (nombre =:nombre) and (contrasenia=:contrasenia) ');
        $statement->bindParam(':nombre', $nombreEmpresa);
        $statement->bindParam(':contrasenia', $contrasenia);
        $statement->execute();

        $result = $statement->fetch();

        $count = $result[0];


        if ($count == 0) {
            echo "<script>
                        alert('Contraseña no válida. Verifique su contraseña.');
                        window.location= '../php/index_backup.php'
                    </script>";
        } else {

            include './Connet.php';
            //$imgData =file_get_contents($dest_path);
            $restorePoint = SGBD::limpiarCadena($dest_path);
            $sql = explode(";", file_get_contents($dest_path));
            
            
            $totalErrors = 0;
            set_time_limit(60);
            $con = mysqli_connect(SERVER, USER, PASS, $nombreBD);
            $con->query("SET FOREIGN_KEY_CHECKS=0");
            for ($i = 0; $i < (count($sql) - 1); $i++) {
                if ($con->query($sql[$i] . ";")) {
                    
                } else {
                    $totalErrors++;
                }
            }
            $con->query("SET FOREIGN_KEY_CHECKS=1");
            $con->close();
            if ($totalErrors <= 0) {
                echo "<script>
                    alert('Restauración completada con éxito!');
                    window.location= '../php/index_restore.php'
                </script>";
            } else {
                echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
            }
        }
    }
}
?>


<!------------------------------------------DESDE ACA INTENTANDO YO---------------------------------------------------------->

<html lang="es">
    <head>
        <script type="text/javascript" src="lib/jquery/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery.edatagrid.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
        <link rel="stylesheet" href="../../estilos/estilos.css">

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    </head>

    <body class="mainBody">  
        <div id="header">
            <ul class="nav">
                <li><a class="a" href="../../login.php">Salir</a></li> 
            </ul>
        </div>


        <form class="formulario" action="index_restore.php" method="POST" enctype="multipart/form-data">

            <div class="contenedor">
                <div class="input-contenedor">
                    <i class="fas fa-key icon"></i>
                    <input type="text" placeholder="Contraseña" name="contrasenia" required>
                </div>

                <br> <input style="margin-left:110px;" type="file" accept=".gz"  name="company_backup" class="form-input">
                <!--<INPUT TYPE="FILE" ACCEPT=".GZ" NAME="ARCHIVO">-->

            </div>
            <button class="button" type="submit" name="restore">Restaurar</button>
            <p>Para llevar a cabo la restauración, ingrese la contraseña que se le solicito al Crear Empresa.</p>


        </form>
    </body>
</html>






