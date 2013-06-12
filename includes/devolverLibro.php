 <BODY ONLOAD="exito();">
<?php
	if($_GET["activar"]=="ok"){
	$hoyday = date("Y/m/d"); 
	$hoy = strtotime($hoyday);

	$id_prestamo = strip_tags($_GET['id']);

	include("conexion.php");
	$consulta = @mysql_query('SELECT * FROM Prestamo WHERE id_prestamo = "'.mysql_real_escape_string($id_prestamo).'"')
			    or die (mysql_error());
	$query = mysql_fetch_array($consulta);
	$id_libro = $query['id_libro'];
	$id_prestamo = $query['id_prestamo'];
	$devolver = $query['fecha_devolver'];
	$id_libro= $query['id_libro'];
	$limite = strtotime($devolver);

	if($limite>=$hoy){
		$day = date("Y/m/d", strtotime($hoyday));
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


	}if($limite<$hoy){
		//echo "<script>alert('La fecha para devolucion EXPIRO el dia $devolver.')</script>";
		$day = date("Y/m/d", strtotime($hoyday));

		$op1=@mysql_query("UPDATE Libros SET 
		estado = 'Disponible'
		WHERE id = '$id_libro'", $link)
		or die(mysql_error());

			if($op1){
				mysql_query("DELETE FROM Prestamo WHERE id_prestamo = '$id_prestamo'", $link)
				or die(mysql_error());
				echo "<script>
				function exito(){
					alert('La fecha para devolucion EXPIRO el dia $devolver')
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
	
?>