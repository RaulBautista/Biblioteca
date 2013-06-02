<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Administrador</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" href="css/demo_table_jui.css">
    <link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.min.css">
    <script src="js/new/jquery.js" type="text/javascript"></script>
    <script src="js/new/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('#datatables').dataTable({
            "sPaginationType":"full_numbers",
            "aaSorting":[[0, "asc"]],
            "bJQueryUI":true
        });
    })        
    </script>
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php") ?>		
		</header>
		<div id="libros">
		<?php
		session_start();
		if ($_SESSION['logged']=='2') { 
			require_once "includes/conexion.php";
			$result = mysql_query("SELECT * FROM Libros ORDER BY id");
		?>
		<div id="botones">
			<a href="InsertarLibro.php" class="insertar">Insertar Nuevo Libro</a>
			<a href="includes/Logout.php" class="cerrar">Cerrar Sesion</a>
		</div>
		<table id="datatables" class="display">
        <thead>
		<TR>
			<th>Autor</th>
			<th id="oculta">Titulo</th>
			<th id="oculta">Edicion</th>
			<th id="oculta">Lugar de Edicion</th>
			<th id="oculta">Editorial</th>
			<th id="oculta">Año de Edicion</th>
			<th id="oculta">Num. de Paginas</th>
			<th id="oculta">Num. ejemplar</th>
			<th id="oculta">Area</th>
			<th>Estado</th>
			<th></th>
			<th></th>
		</TR>
		</thead>
        	<tbody>
               	<?php
                    $contador = 0;
                    while ($row = mysql_fetch_array($result)) {
                    $titulo = $row['titulo'];
					echo "    <script language='javascript'>
    				function confirmar(){
    				if(confirm('Seguro que desea eliminar el libro seleccionado')){document.location.href = 'includes/Eliminar.php?activar=ok&&id=$row[id]';}
    				}
    				</script>";
                    	$contador ++;
                    printf("
					<td>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td><a href='EstadoLibro.php?id=$row[id]' id='btn-tabla'>%s</a></td>
					<td>
						<a href='Modificar.php?id=$row[id]' id='btn-tabla'>Modificar</a>
					</td>
					<td>
					 	<a href='#' onClick='confirmar()'>Eliminar</a>
					</td>							
				</tr>", 
				$row["autor"], $row["titulo"],  $row["edicion"],  $row["lugar_edicion"], $row["editorial"], $row["ano_edicion"], $row["num_paginas"], $row["ejemplar_num"],$row["id_area"], $row["estado"]);
				}
				mysql_free_result($result);
				mysql_close($link);
				?>
                </tbody>
            </table>
		</div>
			<?php }else{
		header("location: index.php");
	} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>