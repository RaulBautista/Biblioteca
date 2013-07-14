<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>alumnos</title>
	<link rel="stylesheet" href="css/design2.css">
    <link rel="stylesheet" href="css/demo_table_jui.css">
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
    <style>
    	@media screen and (min-width : 320px) and (max-width: 480px) {input{max-width: 130px;}}
    </style>
    <script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
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
	<header>
		<img src="img/logo_mini.png" alt="tec">		
		<?php include("includes/menu.php"); ?>	
	</header>
	<section class="contenedor">
		<?php
		session_start();
		if($_SESSION['logged'] == '1') { 
			$usuario = $_SESSION['user'];
			include "includes/menualumno.php";			
			echo "<p class='bienvenido'>Informacion sobre libros que se encuentran en la Biblioteca.</p><hr><br>";
			echo "<br>";			
			require_once "includes/conexion.php";								
		$result = mysql_query("SELECT * FROM Libros ORDER BY id", $link);
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
			</div>
		<?php
	}else{
		header("location: index.php");
	} ?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>