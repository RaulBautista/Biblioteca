<!doctype html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Administrador</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/demo_table_jui.css">
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="css/toastmessage.css">
    <script src="js/new/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="js/new/jquery.dataTables.js" type="text/javascript"></script>
	<script src="js/new/jquery.toastmessage.js"></script>    
    <script type="text/javascript">
    $(document).ready(function(){
        $('#datatables').dataTable({
            "sPaginationType":"full_numbers",
            "aaSorting":[[0, "asc"]],
            "bJQueryUI":true
        });
    });
    </script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">			
		<?php include("includes/menu.php") ?>		
	</header>
	<section class="contenedor">
		<div id="libros">
		<?php
		session_start();
		if ($_SESSION['logged']=='2') { 
			require_once "includes/conexion.php";
			$verificar = mysql_query("SELECT * FROM Prestamo", $link);
			$num = mysql_num_rows($verificar);
			if ($num > 0) { 
			echo"<script>
			function showStickyNoticeToast() {
				$().toastmessage('showToast', {
				text : 'Hay $num libros prestados',
				sticky : false,
				position : 'top-right',
				type : 'notice',
				closeText: '',
				close : function () {console.log('toast is closed ...');}
				}); 
			} 
			showStickyNoticeToast();
			</script> ";
			$hoy = date("Y-m-d H:i:s A");
		 	$vencidos = mysql_fetch_array($verificar);
		 	$fechadevolver = $vencidos['fecha_devolver'];
		 	if ($fechadevolver < $hoy) {
		 	echo"<script>		 		
		 	function showStickyWarningToast() {
				$().toastmessage('showToast', {
				text : '<a href=vencidos.php id=link>Hay prestamos vencidos.<br> Click para verlos</a>',
				sticky : true,
				position : 'top-right',
				type : 'warning',
				closeText: '',
				close : function () {
				console.log('toast is closed ...');
				}
				});
			} 
			showStickyWarningToast();
			</script>";
		 }
		 }
		 $result = mysql_query("SELECT * FROM Libros ORDER BY id");
		 ?>

		<div id="botones">
			<a href="InsertarLibro.php" class="insertar">Insertar Nuevo Libro</a>
			<a href="includes/Logout.php" class="cerrar">Cerrar Sesion</a>
		</div>
		<table id="datatables" class="display">
        <thead>
		<TR>
			<th id="oculta">Autor</th>
			<th>Titulo</th>
			<th id="oculta">Edicion</th>
			<th id="oculta" class="oculta2">Lugar de Edicion</th>
			<th id="oculta">Editorial</th>
			<th id="oculta">Año de Edicion</th>
			<th id="oculta" class="oculta2">Num. de Paginas</th>
			<th id="oculta" class="oculta2">Num. ejemplar</th>
			<th id="oculta" class="oculta2">Area</th>
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
					<td id='oculta'>%s</td>
					<td>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta' class='oculta2'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta'>%s</td>
					<td id='oculta' class='oculta2'>%s</td>
					<td id='oculta' class='oculta2'>%s</td>
					<td id='oculta' class='oculta2'>%s</td>
					<td><a href='EstadoLibro.php?id=$row[id]' id='btn-tabla'>%s</a></td>
					<td>
						<a href='Modificar.php?id=$row[id]' id='btn-tabla'>Modificar</a>
					</td>
					<td>
					 	<a href='#' onClick='confirmar()'><img src='img/delete.png'></a>
					</td>							
				</tr>", 
				$row["autor"], $row["titulo"],  $row["edicion"],  $row["lugar_edicion"], $row["editorial"], $row["ano_edicion"], $row["num_paginas"], $row["ejemplar_num"],$row["area"], $row["estado"]);
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
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
</body>
</html>