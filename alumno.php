<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>alumnos</title>
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
			<h1>Instituto Tecnologico De Iztapalapa II<br>Biblioteca</h1>
			<?php include("includes/menu.php"); ?>	
		</header>
		<?php
		session_start();
		if($_SESSION['logged'] == '1') { 
		include "includes/menualumno.php";
		echo "<p id='bienvenido'>Bienvenido <strong>$_SESSION[user]</strong> </p><br>";
		require_once "includes/conexion.php";
		//echo gettype($link);
		//echo is_resource($link);
		//echo get_resource_type($link);
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
		header("location: colecciones.php");
	} ?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/tecnologicodeiztapalapall.instituto?fref=ts"><img src="img/facebook.png" alt="Redes Sociales"></a>
	</footer>
	</section>
</body>
</html>