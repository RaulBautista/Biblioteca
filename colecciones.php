<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
	<style>
	#load{
		margin-top: -10px;
		width: 20px;
	}
	</style>
	<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/new/jquery-1.9.1.min.js"></script>
  	<script type="text/javascript" src="js/new/formularioJquery.js"></script>
  	<script type="text/javascript" src="js/new/jquery-ui-1.10.3.custom.min.js"></script>
  	<script type="text/javascript" src="js/new/modernizr.custom.32453.js"></script>
  	<script>
  	function validaForm(){
    if($('#numcontrol').val().length < 9){
        $('#mensaje').html('Tu numero de control debe tener 9 numeros').hide().fadeIn(900).delay(3400).fadeOut(500);
        $('#numcontrol').focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else if($('#pass').val().length < 3){
        $('#mensaje').html('Tu contraseña debe ser mayor a 3 caracteres').hide().fadeIn(900).delay(3400).fadeOut(500);
        $('#pass').focus();
        return false;
    }
    return true; // Si todo está correcto
	}
  	$(document).ready(function(){
		$("#formlogin").submit(function (event) {
			event.preventDefault();
			if(validaForm()){
				$('#mensaje').html('<img src="img/load-indicator.gif" alt="..." id="load"/>').hide().fadeIn(500);
				$.post("includes/login.php",$('#formlogin').serialize(),function(res){                
            		if(res == "error"){
           				$('#mensaje').html('No estas registrado o tus datos son incorrectos. Verificalos por favor').hide().fadeIn(500);
            		}else if(res == "exito"){            		
            			window.location='alumno.php';
            		}else{
            			window.location='colecciones.php';
            		}
            	});            	        
        	}else{
        		return false;
        	}
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
					<img src="img/logo.png" alt="tec" class="logo_tec">
				</div>
			</p> <br>
			<p>
				<div class="cont">
				<h1>Iniciar sesión</h1><br>
				<form id="formlogin" method="post">
        			<select name="tipo" id="tipo">
               		 	<option value="1">Alumno</option>
               			<option value="2">Administrador</option>
        			</select><br>
					<input type="text" id="numcontrol" name="numcontrol" placeholder="Numero de Control" maxlength="9" title="No. de control de 9 numeros" required /><br>
					<input type="password" id="pass" name="pass" placeholder="Contraseña" title="ingresa tu contraseña" required /><br>
					<input type="submit" id="boton" class="boton2" style="margin:0;" value="Entrar" />
				</form><br>				
				<div id="mensaje" style="color: darkred;"></div>
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
    		<input type="text" name="semestre" id="semestre" value="" class="text ui-widget-content ui-corner-all" />
  			</fieldset>
  			</form>
			</div>
			<br><br>
			<button id="create-user" style="display: block; margin: 0 auto;">Crea una cuenta</button>
			<div class="exito"></div>
			<?php }?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>