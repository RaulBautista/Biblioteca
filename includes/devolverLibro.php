 <BODY ONLOAD="exito();">
<?php
	session_start();
	if(!$_SESSION['logged']=='2'){
		header("location: ../colecciones.php");
		exit();
	}else{
	if($_GET["activar"]=="ok"){
	$hoy = date("Y-m-d H:i:s A");
	$id_prestamo = strip_tags($_GET['id']);
	include("conexion.php");
	$consulta = @mysql_query('SELECT * FROM Prestamo WHERE id_prestamo = "'.mysql_real_escape_string($id_prestamo).'"') or die (mysql_error());
	$query = mysql_fetch_array($consulta);
	$id_libro = $query['id_libro'];
	$id_prestamo = $query['id_prestamo'];
	$devolver = $query['fecha_devolver'];
	$id_libro= $query['id_libro'];
	$limite = date("Y-m-d H:i:s A", strtotime($devolver));
	if($limite >= $hoy){
		//echo "<script>alert('Justo a tiempo')</script>";
		$op1=@mysql_query("UPDATE Libros SET 
		estado = 'Disponible'
		WHERE id = '$id_libro'", $link)
		or die(mysql_error());

			if($op1){
				mysql_query("DELETE FROM Prestamo WHERE id_prestamo = '$id_prestamo'", $link)
				or die(mysql_error());
				
				echo "<script>
				function exito(){
					alert('Devolucion realizada a tiempo')
					document.location.href='../colecciones.php';
				}
				</script>";
			}else{
				echo "<script>
				function exito(){
					alert('Error, Intente mas tarde')
					document.location.href='../colecciones.php';
				}
				</script>";
			}


	}if($limite < $hoy){
		//echo "<script>alert('La fecha para devolucion EXPIRO el dia $devolver.')</script>";
		$op1=@mysql_query("UPDATE Libros SET 
		estado = 'Disponible'
		WHERE id = '$id_libro'", $link)
		or die(mysql_error());

			if($op1){
				mysql_query("DELETE FROM Prestamo WHERE id_prestamo = '$id_prestamo'", $link)
				or die(mysql_error());
				$fecha = date("j M Y - g:i:s A ", strtotime($devolver));
				echo "<script>
				function exito(){
					alert('La fecha para devolucion EXPIRO el dia $fecha')
					document.location.href='../colecciones.php';
				}
				</script>";
			}else{
				echo "<script>
				function exito(){
					alert('Error, Intente mas tarde')
					document.location.href='../colecciones.php';
				</script>";			
				}
	}
}
}
	
?>