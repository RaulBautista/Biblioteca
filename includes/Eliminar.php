<?php
	if($_GET["activar"]=="ok"){
		include("conexion.php");

		$id=$_GET['id'];
	    mysql_query("DELETE FROM Libros WHERE id = $id", $link);
	   
	    header("Location: ../colecciones.php");
	}
?>