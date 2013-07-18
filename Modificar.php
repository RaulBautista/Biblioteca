<!DOCTYPE HTML>
<html lang="es-Es">
<head>
	<meta charset="UTF-8" />
	<title>Modificar</title>
	<link rel="stylesheet" href="css/design.css">
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php"); ?>
		</header>

		<?php
		session_start();
		if($_SESSION['logged'] == '2') { 
		header ('Content-type: text/html; charset=utf-8'); 
		require ("includes/conexion.php");
		error_reporting(E_ALL & ~E_NOTICE); 
		if(isset($_GET['id'])) {

			$id = strip_tags($_GET['id']);
			$sql = mysql_query("SELECT * FROM Libros
			WHERE id = $id", $link)
			or die(mysql_error());
			$row = mysql_fetch_array($sql);
			echo "<p id='bienvenido'> Actualizar Datos del libro: <strong>$row[titulo]</strong></p>";
		}

		if(isset($_POST['alta']) == 'alta'){
			//utf8_encode
			$id = strip_tags($_POST['id']);
			$autor = strip_tags($_POST['autor']);
			$titulo = strip_tags($_POST['titulo']);
			$edicion = strip_tags($_POST['edicion']);
			$lugar = strip_tags($_POST['lugar']);
			$editorial = strip_tags($_POST['editorial']);
			$ano = strip_tags($_POST['ano']);
			$paginas = strip_tags($_POST['paginas']);
			$ejemplar_num = strip_tags($_POST['ejemplar_num']);
			$area = strip_tags($_POST['id_area']);
			$estado = strip_tags($_POST['estado']);

			//htmlentities


			mysql_query ("UPDATE Libros SET 
				id = '$id',
				autor = '$autor',
				titulo = '$titulo',
				edicion = '$edicion',
				lugar_edicion = '$lugar',
				editorial = '$editorial',
				ano_edicion = '$ano',
				num_paginas = '$paginas',
				ejemplar_num = '$ejemplar_num',
				area = '$area',
				estado = '$estado'
				WHERE id = '$id'", $link)
				or die(mysql_error());

				echo "<p align='center'> Registro actualizado correctamente </p> <br>
				<a href='colecciones.php' class='boton'>Regresar</a>
				";

		}else{
		echo "<p>".$mensaje."</p>";
		//utf8_encode(
		?>

		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" id="nuevo">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>" required/><br>
			<label>Autor:</label>
			<input type="text" name="autor" value="<?php echo $row['autor']; ?>" required /><br>
			<label>Titulo:</label>
			<input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required /><br>
			<label>Edicion:</label>
			<input type="text" name="edicion" value="<?php echo $row['edicion']; ?>" required /><br>
			<label>Lugar de Edicion:</label>
			<input type="text" name="lugar" value="<?php echo $row['lugar_edicion']; ?>" required /><br>
			<label>Editorial:</label>
			<input type="text" name="editorial" value="<?php echo $row['editorial']; ?>" required /><br>
			<label>Año de Edicion:</label>
			<input type="text" name="ano" value="<?php echo $row['ano_edicion']; ?>" required /><br>
			<label>Numero de Paginas:</label>
			<input type="text" name="paginas" value="<?php echo $row['num_paginas']; ?>" required /><br>
			<label>Numero de ejemplar:</label>
			<input type="text" name="ejemplar_num" value="<?php echo $row['ejemplar_num']; ?>" required /><br>
			<label>Area del libro: </label>
			<select name="id_area" title="Seleccione area" required >
				<option value="">Seleccione una opción</option>
				<option value="Programación">Programación</option>
				<option value="Historia">Historia</option>
				<option value="Química">Química</option>
				<option value="Matemáticas">Matemáticas</option>
 			</select>
			<!-- <input type="text" name="id_area" value="<?php echo $row['id_area']; ?>" required /><br> -->
			<label>Estado: </label>
			<input type="text" name="estado" value="<?php echo $row['estado']; ?>" readonly /><br>
			<input type="submit" name="alta" value="Aceptar Cambios" />
		</form>		
		<a href="colecciones.php" class="boton">Cancelar</a>
	<?php }
	}else{
		header("location: index.php");
	}
	 ?>
		<footer>
			<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		</footer>
	</section>
</body>
</html>