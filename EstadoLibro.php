<!DOCTYPE HTML>
<html lang="es-Es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Libros</title>
	<link rel="stylesheet" href="css/design.css" />
	<link rel="stylesheet" href="css/tabla.css">
	<link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.min.css" />
	<script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/new/modernizr.custom.32453.js"></script>
	<script src="js/new/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript">
	$(document).ready
    if (!Modernizr.inputtypes.date) {
    $(function calendario(){
        $("input[type=date]").datepicker();
    	});
	}
	if(Modernizr.input.required){
		 $("#nuevo").validate();
	}
	</script>
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php") ?>
		</header>
		<?php 
		session_start();
		if($_SESSION['logged']=='2'){
		//header ('Content-type: text/html; charset=utf-8');
		require_once ("includes/conexion.php");
		$id = strip_tags($_GET['id']);
		$consulta = mysql_query("SELECT * FROM Libros
			WHERE id = $id", $link)
			or die(mysql_error());
			$fila = mysql_fetch_array($consulta);
			$estado = strtoupper($fila["estado"]);
		if ($estado == strtoupper('disponible')) {
		?>
		<br><p align="center">Llenar formulario para realizar el prestamo </P><br>
		<form method="POST" action="PrestarLibro.php" id="nuevo" >
			<label>ID del Libro: </label>
			<input type="text" name="id_libro"  value="<?php echo $fila['id']; ?>" readonly /><br>
			<label>No. control del alumno: </label>
			<input type="text" name="numcontrol_alum" placeholder="Numero de 9 digitos" title="Se requiere No. control del alumno" required /><br>
			<label>Fecha de prestamo: </label>
			<input type="date" name="fechaprestamo" placeholder="Fecha de hoy" required />
			<label>Limite limte para devolver: </label>
			<input type="date" name="fechadevolver" required />
			<label>Observaciones del libro: </label>
			<input type="text" name="observacion"  placeholder="Acerca del libro"/><br>
			<input type="submit" name="prestar" value="Aceptar prestamo">
		</form>
		<a href="colecciones.php" class="boton">Cancelar</a>
		<?php 
		}elseif ($estado == strtoupper('prestado')){ 
			$consulta = @mysql_query('SELECT * FROM Prestamo WHERE id_libro = "'.mysql_real_escape_string($id).'"')
			or die (mysql_error()); 
			?>
		<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1>
	<thead>
		<TR>
			<TH>Id libro</TH>
			<TH>No.control alumno</TH>
			<TH>Fecha prestamo</TH>
			<TH>Limite devolucion</TH>
			<TH>Observacion</TH>
			<TH>Devolucion</TH>
		</TR>
	</thead>
<?php
	while ($row = mysql_fetch_array($consulta)) {
	$alumno = $row['numcontrol_alum'];
	echo "    <script language='javascript'>
    function confirmar(){
    if(confirm('Aceptar devolucion del alumno con no. de control $alumno')){document.location.href = 'includes/devolverLibro.php?activar=ok&&id=$row[id_prestamo]';}
    }
    </script>";

		printf("<tr><td>%s</td>
					<td><a href='datosAlumno.php?numcontrol=$row[numcontrol_alum]&id=$id'>%s</a></td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
					<a href='#' onClick='confirmar()'>devolver</a>	
					</td>			
				</tr>", 
				$row["id_libro"], $row["numcontrol_alum"], $row["fecha_prestamo"], $row["fecha_devolver"],$row["observacion"]);
	}
	mysql_free_result($consulta);
	mysql_close($link);

?>
	</TABLE>
		<a href="colecciones.php" class="boton">Regresar</a>
		<?php
		} 
		}else{
			header("location: colecciones.php");
		} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>