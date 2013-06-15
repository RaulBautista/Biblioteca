<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Logeo</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" type="text/css" href="css/style4.css" />
	<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
	<script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
  	<script type="text/javascript" src="js/new/formularioJquery.js"></script>
  	<script type="text/javascript" src="js/new/jquery-ui-1.10.3.custom.min.js"></script>
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php") ?>		
		</header>

			<?php
			error_reporting(E_ALL & ~E_NOTICE);  
			session_start();
			if ($_SESSION['logged'] == '1') {
			header ("Location: alumno.php"); 
			}
			elseif($_SESSION['logged'] == '2') {
			header ("location: administrador.php");
			?>
			<br>
			<?php }else{ ?>

			<div id="paginaColeccion">
			<p>
				<div class="cont">
					<h1>Accede a la BD de la Biblioteca</h1><br>
					<img src="img/logo.png" alt="tec">
				</div>
			</p><br>
			<p>
				<div class="cont">
				<h1>Iniciar sesión</h1><br>
				<form action="includes/login.php" method="POST" id="signupform">
        			<select name="tipo" id="tipo">
               		 	<option value="1">Alumno</option>
               			<option value="2">Administrador</option>
        			</select><br>
					<label>No. control:</label>
					<input type="text" name="numcontrol" placeholder="Numero de Control" title="No. de control de 9 numeros" required /><br> <!--autofocus -->
					<label>Password:</label>
					<input type="password" name="pass" placeholder="Contraseña" title="ingresa tu contraseña" required /><br>
					<input type="submit" id="boton" value="Entrar" />
				</form>
				</div>
				</p>
			<br>
		</div>
		<div id="dialog-form" title="Registro de alumno">
  			<p class="validateTips">Ingrese sus datos por favor</p>
  			<form id="form">
  			<fieldset>
    		<label for="name">Nombre completo</label>
    		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
    		<label for="nocontrol">No. Control</label>
    		<input type="text" name="nocontrol" id="nocontrol" value="" class="text ui-widget-content ui-corner-all" />
    		<label for="email">Email</label>
    		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
    		<label for="password">Password</label>
    		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
    		<label for="carrera">Carrera</label>
    		<select name="tipo" id="tipo">
    					<option value="">Elije una carrera</option>
               		 	<option value="Tics">Tics</option>
               			<option value="Loguistica">Logística</option>
               			<option value="Administracion">Administracion</option>
        			</select>
    		<label for="semestre">Semestre</label>
    		<input type="semestre" name="semestre" id="semestre" value="" class="text ui-widget-content ui-corner-all" />
  			</fieldset>
  			</form>
			</div>
			<br>
			<button id="create-user">Crea una cuenta</button>
			<div class="exito"></div>
			<?php }?>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>