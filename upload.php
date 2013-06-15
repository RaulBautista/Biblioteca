<?php
error_reporting(E_ALL);
session_start();
if ($_SESSION['logged'] == '1') {
require "includes/conexion.php";
$ds          = DIRECTORY_SEPARATOR;
$storeFolder = 'uploads';
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $targetFile =  $targetPath. $_FILES['file']['name'];
    //Obtener extencion
    $archivo=array($targetFile);
    foreach ($archivo as $name){
        $ext=explode(".",$name);
        $num=count($ext)-1;
    }
    //echo $_FILES['file']['name'];
    if ($ext[$num] == 'pdf') {
        $query1 = mysql_query("SELECT titulo FROM Articulos");
        $row = mysql_fetch_array($query1);
        $titulo = $row['titulo'];
        if ($_FILES['file']['name'] == $titulo) {
            echo "existe";
            exit();
        }
        $subir = move_uploaded_file($tempFile,$targetFile);
        chmod($targetFile, 0777);
        if ($subir) {
            $autor = $_SESSION['user'];
    	   $ruta = $storeFolder."/".$_FILES['file']['name'];
    	   $titulo = $_FILES['file']['name'];
    	   $query = @mysql_query('INSERT INTO Articulos (titulo, ruta, autor, up, down) VALUES ("'.mysql_real_escape_string($titulo).'","'.mysql_real_escape_string($ruta).'","'.$autor.'", 0, 0)');
    	   if ($query) {
    		  echo "Insersion exitosa";
            }else{
    		echo "Error en insert";
    	   }
        }else{
    	   echo "Error";
        }
    }else{
        echo "Formato no valido";
    }
}
}else{
    header("location: index.php");
}
?>  