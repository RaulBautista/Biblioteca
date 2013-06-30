<!doctype html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Eliminar libro</title>
	<link rel="stylesheet" href="../css/design.css">
</head>
<body>
<?php
	if($_GET["activar"]=="ok"){
		$id=$_GET['id'];
		include("conexion.php");
		$query = mysql_query("SELECT estado FROM Libros where id = $id", $link);
		$row = mysql_fetch_array($query);
		$estado = strtoupper($row['estado']);
		if($estado = strtoupper("disponible")){
			echo "			
			<script>
				alert('No se puede eliminar debido a que el estado del libro es PRESTADO')
				document.location.href='../colecciones.php';
			</script>
			";
			exit();
		}else{
	    	mysql_query("DELETE FROM Libros WHERE id = $id", $link);
	    	header("Location: ../colecciones.php");
		}
	}
?>
</body>
</html>