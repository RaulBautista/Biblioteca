<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Altas</title>
	<link rel="stylesheet" href="css/design.css">
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
		if ($_SESSION['logged'] == '2') {
		header ('Content-type: text/html; charset=utf-8');
		require_once ("includes/conexion.php");

		if(isset($_POST['alta']) == 'alta'){
			
		$autor = strip_tags(htmlentities($_POST['autor']));
		$titulo = strip_tags(htmlentities($_POST['titulo']));
		$edicion = strip_tags(htmlentities($_POST['edicion']));
		$lugar_edicion = strip_tags(htmlentities($_POST['lugar_edicion']));
		$editorial = strip_tags(htmlentities($_POST['editorial']));
		$ano_edicion = strip_tags($_POST['ano_edicion']);
		$num_paginas = strip_tags($_POST['num_paginas']);
		$ejemplar_num = strip_tags($_POST['ejemplar_num']);
		$id_area = strip_tags($_POST['id_area']);

		$query = @mysql_query('SELECT * FROM Libros WHERE titulo="'.mysql_real_escape_string($titulo).'"');
		$row = mysql_fetch_array($query);
		$titulos = $row['titulo'];
		$ejemplar_nums = $row['ejemplar_num'];
			//if($existe = @mysql_fetch_object($query))
		if(($ejemplar_nums == $ejemplar_num) && ($titulos == $titulo)){
				echo "
				<p align='center'> Asigne correctamente el numero de ejemplar del libro $titulo. </p> <br>
				<a href='colecciones.php' class='boton'>Regresar</a>";
			}else{
			$meter = @mysql_query('INSERT INTO Libros (
				autor,
				titulo,
				edicion, 
				lugar_edicion, 
				editorial, 
				ano_edicion, 
				num_paginas, 
				ejemplar_num,
				id_area,
				estado)
			values
			("'.mysql_real_escape_string($autor).'",
			"'.mysql_real_escape_string($titulo).'",
			"'.mysql_real_escape_string($edicion).'",
			"'.mysql_real_escape_string($lugar_edicion).'",
			"'.mysql_real_escape_string($editorial).'",
			"'.mysql_real_escape_string($ano_edicion).'",
			"'.mysql_real_escape_string($num_paginas).'",
			"'.mysql_real_escape_string($ejemplar_num).'",
			"'.mysql_real_escape_string($id_area).'","Disponible")');
			if($meter)
			{
				echo" <p align='center'> Libro registrado con exito </p> <br>
				<a href='colecciones.php' class='boton'>Regresar</a>";
			}else{
				echo "<p align='center'> Ha ocurrido un error en su registro. Intentelo mas tarde </p> <br>
				<a href='colecciones.php' class='boton'>Cancelar</a>";	
			}
			}
		}else{
		echo "<p id='bienvenido'>Formulario para ingresar un nuevo libro a la BD </p>";
		?>

		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" id="nuevo">
			<label>Autor:</label>
			<input type="text" name="autor" required /><br>
			<label>Titulo:</label>
			<input type="text" name="titulo" required /><br>
			<label>Edicion:</label>
			<input type="text" name="edicion" /><br>
			<label>Lugar de Edicion:</label>
			<input type="text" name="lugar_edicion" /><br>
			<label>Editorial:</label>
			<input type="text" name="editorial" required /><br>
			<label>Año de Edicion:</label>
			<input type="text" name="ano_edicion" /><br>
			<label>Numero de Paginas:</label>
			<input type="number" min="0" name="num_paginas" /><br>
			<label>Numero de ejemplar: </label>
			<input type="number" min="0" name="ejemplar_num"required /><br>
			<label>Area:</label>
			<select name="id_area" title="Seleccione area" required >
				<option value="">Seleccione una opcion</option>
				<option value="001">Programacion</option>
				<option value="002">Historia</option>
				<option value="003">Quimica</option>
				<option value="004">Matematicas</option>
 			</select><br>
			<input type="submit" name="alta" value="Dar de Alta" />
		</form>
		<a href="colecciones.php" class="boton">Cancelar</a>
		<?php 
		}
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