<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>alumnos</title>
	<link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="css/demo_table_jui.css">
    <link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.min.css">
    <style>
    	@media screen and (min-width : 320px) and (max-width: 480px) {input{max-width: 130px;}}
    </style>
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
			<h1>Instituto Tecnologico De Iztapalapa II<br>Biblioteca</h1>
			<?php include("includes/menu.php"); ?>	
		</header>
		<?php
		session_start();
		if($_SESSION['logged'] == '1') { 
		$usuario = $_SESSION['user'];
		include "includes/menualumno.php";
		require_once "includes/conexion.php";
		echo "<div id='bienvenido'><p>Bienvenido <strong>$usuario</strong></p></div>";
		$consultap = mysql_query("SELECT id, pregunta, total FROM Preguntas where autor ='$usuario'", $link);
		$numero_preguntas = mysql_num_rows($consultap);
		if ($numero_preguntas > 0) { ?>
			<div id="mispreguntas">
			<?php
			echo "<p>Tienes $numero_preguntas preguntas realizadas en el foro</p>";
			while ($preguntas = mysql_fetch_array($consultap)) {
				$total = $preguntas['total'];
				if ($total == 0) {
					$total = 'Parece que nadie a visto tu pregunta aun';
					echo "<style type='text/css'>#ocul{display: none;}</style>";
				}
				echo "<a href='respuestas.php?id=$preguntas[id]'><p><b>$preguntas[pregunta]:</b> <span id='ocul'>respuestas: </span>$total</p></a>";
			} ?>
			</div>
		<?php }
		//echo gettype($link);
		//echo is_resource($link);
		//echo get_resource_type($link);
		$dato = mysql_query("SELECT numcontrol FROM Alumnos WHERE nombre ='$usuario'", $link);
		$datos = mysql_fetch_array($dato);
		$numcontrol = $datos['numcontrol'];

		$hoy = date("Y-m-d H:i:s A");
		$consult = mysql_query("SELECT fecha_devolver FROM Prestamo WHERE numcontrol_alum = '$numcontrol' ORDER BY fecha_devolver ", $link);
		$num = mysql_num_rows($consult);
		if ($num > 0) {
			echo "<script src='js/new/jquery.toastmessage.js'></script>
				<link rel='stylesheet' href='css/toastmessage.css'>";
			while ($devolver = mysql_fetch_array($consult)) {
			$fecha = date("j M Y - g:i A", strtotime($devolver['fecha_devolver']));
			$fecha_comparar = date("Y-m-d H:i:s A", strtotime($devolver['fecha_devolver']));
			if ($fecha_comparar < $hoy) {
			echo"<script>
			function showStickyNoticeToast() {
				$().toastmessage('showToast', {
				text : 'Debiste devolver a la Biblioteca un libro antes del: <br> $fecha',
				sticky : false,
				stayTime: 7000,
				position : 'top-right',
				type : 'error',
				closeText: '',
				close : function () {console.log('toast is closed ...');}
			}); 
			} 
			showStickyNoticeToast();
			</script> ";			
			}else{
			echo"<script>
			function showStickyNoticeToast() {
				$().toastmessage('showToast', {
				text : 'Debes devolver a la Biblioteca un libro antes del: <br> $fecha',
				sticky : false,
				position : 'top-right',
				type : 'warning',
				closeText: '',
				close : function () {console.log('toast is closed ...');}
				}); 
			} 
			showStickyNoticeToast();
			</script> ";			
			}
		}
		}
		$result = mysql_query("SELECT * FROM Libros ORDER BY id");
		?>
		<table id="datatables" class="display">
        <thead>
		<TR>
			<th id="oculta"></th>
			<th>Autor</th>
			<th>Titulo</th>
			<th id="oculta">Edicion</th>
			<th id="oculta">Lugar de Edicion</th>
			<th>Editorial</th>
			<th id="oculta">Año de Edicion</th>
			<th id="oculta">No. de Paginas</th>
			<th id="oculta">Ejemplar No.</th>
			<th>Estado</th>
		</TR>
	</thead>
                <tbody>
                    <?php
                    $contador = 0;
                    while ($row = mysql_fetch_array($result)) {
                    	$contador ++;
                        ?>
                        <tr>
                            <td id="oculta"><?=$contador?></td>
                            <td><?=$row['autor']?></td>
                            <td><?=$row['titulo']?></td>
                            <td id="oculta"><?=$row['edicion']?></td>
                            <td id="oculta"><?=$row['lugar_edicion']?></td>
                            <td><?=$row['editorial']?></td>
                            <td id="oculta"><?=$row['ano_edicion']?></td>
                            <td id="oculta"><?=$row['num_paginas']?></td>
                            <td id="oculta" ><?=$row['ejemplar_num']?></td>                   
                            <td><?=$row['estado']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

	<?php }else{
		header("location: index.php");
	} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>