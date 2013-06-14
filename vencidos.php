<!doctype html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Prestamos Vencidos</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" href="css/tabla.css">
	<style>
		#color{ color: crimson;}
	</style>
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
		if ($_SESSION['logged']=='2') {
			require_once "includes/conexion.php";
			$hoy = date("Y-m-d H:i:s A");
			$query =  mysql_query("SELECT fecha_devolver FROM Prestamo");
			$row = mysql_fetch_array($query);
			$fecha_devolver = $row['fecha_devolver'];
			if ($fecha_devolver < $hoy) {
				$vencidos = mysql_query("SELECT * FROM Prestamo where fecha_devolver < '$hoy'");
				$num = mysql_num_rows($vencidos);
				?>
				<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1>
					<thead>
						<TR>
							<TH>Id libro</TH>
							<TH>No.control alumno</TH>
							<TH>Fecha de prestamo</TH>
							<TH>Fecha de devolucion</TH>
							<TH id='oculta'>Observacion</TH>
						</TR>
					</thead>
				<?php
				while ($datos = mysql_fetch_array($vencidos)) {
				printf("<tr><td>%s</td>
						<td>%s</td>
						<td>%s</td>
						<td id='color'>%s</td>
						<td id='oculta'>%s</td>		
					</tr>", 
				$datos["id_libro"], $datos["numcontrol_alum"], date("j M Y - g:i:s A ", strtotime($datos["fecha_prestamo"])), date("j M Y - g:i:s A ", strtotime($datos["fecha_devolver"])),$datos["observacion"]);
				}
				mysql_close($link);
				?>
				</TABLE>
				<?php 
					echo "<a href='administrador.php' class='boton'>Aceptar</a>";
				} ?>
		<?php }else{header("Location: index.php"); exit(); } ?>
		<footer>
			<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		</footer>
	</section>
</body>
</html>