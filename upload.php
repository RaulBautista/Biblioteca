<?php
error_reporting(E_ALL);
session_start();
//ini_set('display_errors', '1');
$ds          = DIRECTORY_SEPARATOR;
$storeFolder = 'uploads';
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $targetFile =  $targetPath. $_FILES['file']['name'];
    $subir = move_uploaded_file($tempFile,$targetFile);
    error_reporting(E_ALL);
    chmod($targetFile, 0777);
    if ($subir) {
        $autor = $_SESSION['user'];
    	$ruta = $storeFolder."/".$_FILES['file']['name'];
    	$titulo = $_FILES['file']['name'];
    	require "includes/conexion.php";
    	$query = @mysql_query('INSERT INTO Articulos (titulo, ruta, autor, up, down) VALUES ("'.mysql_real_escape_string($titulo).'","'.mysql_real_escape_string($ruta).'","'.$autor.'", 0, 0)');
    	if ($query) {
    		echo "Insersion exitosa";
    	}else{
    		echo "Error en insert";
    	}
    }else{
    	echo "Error";
    }
}
?>  