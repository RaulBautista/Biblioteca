<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Colecciones</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" type="text/css" href="css/style4.css" />
	<script type="text/javascript" src="js/new/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/new/slide.js"></script>
	<script language="javascript" type="text/javascript" src="js/new/slidecoleccion.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

	<script type="text/javascript">
 		$(document).ready( function(){	
		// buttons for next and previous item						 
		var buttons = { previous:$('#jslidernews1 .button-previous') ,
						next:$('#jslidernews1 .button-next') };
		 $obj = $('#jslidernews1').lofJSidernews( { interval : 4000,
											 	easing			: 'easeInOutQuad',
												duration		: 1200,
												auto		 	: true,
												maxItemDisplay  : 3,
												startItem		:1,
												navPosition     : 'horizontal', // horizontal
												navigatorHeight : null,
												navigatorWidth  : null,
												mainWidth:980,
												buttons:buttons} );		
	});
</script>
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II</h1>
			<?php include("includes/menu.php") ?>		
		</header>
		<section id="libros">
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
			<section class="acceso">
				<div id="botones">
					<a href="#" id="desocultari">Inicia Sesion</a> o 
					<a href="#" id="desocultarr">Registrate</a>
				</div>
				<form action="includes/login.php" method="POST" id="formulario1">
					<select name="tipo">
						   <option value="1">Alumno</option>
						   <option value="2">Administrador</option>
 					</select><br>
					<input type="text" name="numcontrol" placeholder="Numero de Control" required />
					<input type="password" name="pass" placeholder="Contraseña" required /><br>
					<input type="submit" id="boton" value="Entrar" />
				</form>
				<form action="includes/registro.php" method="POST" id="formulario2">
					<input type="text" name="numcontrol" placeholder="Ingrese Numero de Control" required />
					<input type="text" name="nombre" placeholder="Ingrese su Nombre Completo" required />
					<input type="password" name="pass" placeholder="Ingrese Una Contraseña" required />
					<input type="email" name="correo" placeholder="Ingrese Su E-mail" required /><br>
					<input type="submit" id="boton" value="Registarme" name="registro"/>
				</form>
			</section><br><br>
<div id="jslidernews1" class="lof-slidecontent" style="max-width:920px; height:340px;">
	<div class="preload"><div></div></div>
    	<div  class="button-previous"></div>
            <div  class="button-next"></div>
            	<div class="main-slider-content" style="width:900px; height:340px;">
                	<ul class="sliders-wrap-inner">
                    	<li>
                          	<img src="img/thumbl_980x340.png" title="Newsflash 2" max-width="900px">           
                          	<div class="slider-description">
                            	<div class="slider-meta"><a target="_parent" title="Newsflash 1" href="#Category-1">/ Bienvenido! /</a> <i> — Diciembre 2012</i></div>
                            	<h4>Instituto Tecnologico de Iztapalapa II</h4>
                            	<p>En esta pagina puedes encontrar algun libro de tu interes.
                            		<a class="readmore" href="Busqueda.php"> Buscar </a>
                            	</p>
                			</div>
                    	</li> 
	                   <li>
	                      <img src="img/feliz navidad.jpg" title="Feliz Navidad" >           
	                         <div class="slider-description">
	                           <div class="slider-meta"><a target="_parent" title="Feliz Navidad" href="#Category-2">/ Felices Fiestas /</a> 	<i> — Diciembre 2012</i></div>
	                            <h4>El Instituto Tecnologico de Iztapalapa II</h4>
	                            <p>Les desea Felices fiestas decembrinas!
	                            <a class="readmore" href="http://www.itiztapalapa2.edu.mx/"> Pagina Oficial </a>
	                            </p>
	                         </div>
	                    </li> 
	                   <li>
	                      <img src="img/thumbl_980x340_003.png" title="Newsflash 3" >            
	                        <div class="slider-description">
	                          <div class="slider-meta"><a target="_parent" title="Newsflash 3" href="#Category-3">/ Newsflash 3 /</a> 	<i> — Monday, February 15, 2010 12:42</i></div>
	                            <h4>Content of Newsflash 3</h4>
	                            <p>With a library of thousands of free Extensions, you can add what you need as your site grows. Don't...
	                            <a class="readmore" href="#">Read more </a>
	                            </p>
	                         </div>
	                    </li> 
	                    <li>
	                      <img src="img/thumbl_980x340_004.png" title="Newsflash 5" >            
	                        <div class="slider-description">
	                          <div class="slider-meta"><a target="_parent" title="Newsflash 4" href="#Category-4">/ Newsflash 4 /</a>	<i> — Monday, February 15, 2010 12:42</i></div>
	                            <h4>Content of Newsflash 4</h4>
	                            <p>Joomla! 1.5 - 'Experience the Freedom'!. It has never been easier to create your own dynamic Web...
	                            <a class="readmore" href="#">Read more </a>
	                            </p>
	                         </div>
	                    </li> 
	                    <li>
	                      <img src="img/thumbl_980x340_005.png" title="Newsflash 5" >            
	                        <div class="slider-description">
	                           <div class="slider-meta"><a target="_parent" title="Newsflash 5" href="#">/ Newsflash 5 /</a>	<i> — Monday, February 15, 2010 12:42</i></div>
	                           <h4>Content of Newsflash 5</h4>
	                            <p>Joomla! 1.5 - 'Experience the Freedom'!. It has never been easier to create your own dynamic Web...
	                            <a class="readmore" href="#">Read more </a>
	                            </p>
	                         </div>
	                    </li> 
	                    <li>
	            
	                      <img src="img/thumbl_980x340_006.png" title="Newsflash 5" >            
	                        <div class="slider-description">
	                          <div class="slider-meta"><a target="_parent" title="Newsflash 6" href="#">/ Newsflash 6 /</a>	<i> — Monday, February 15, 2010 12:42</i></div>
	                            <h4>Content of Newsflash 6</h4>
	                            <p>Joomla! 1.5 - 'Experience the Freedom'!. It has never been easier to create your own dynamic Web...
	                            <a class="readmore" href="#">Read more </a>
	                            </p>
	                         </div>
	                    </li> 
	                     <li>
	                      <img src="img/thumbl_980x340_007.png" title="Newsflash 5" >            
	                        <div class="slider-description">
	                          <div class="slider-meta"><a target="_parent" title="Newsflash 7" href="#">/ Newsflash 7 /</a>	<i> — Monday, February 15, 2010 12:42</i></div>
	                            <h4>Content of Newsflash 7</h4>
	                            <p>Joomla! 1.5 - 'Experience the Freedom'!. It has never been easier to create your own dynamic Web...
	                            <a class="readmore" href="#">Read more </a>
	                            </p>
	                         </div>
	                    </li> 
	                      <li>
	                      <img src="img/thumbl_980x340_008.png" title="Newsflash 8" >            
	                        <div class="slider-description">
	        
	                          <div class="slider-meta"><a target="_parent" title="Newsflash 8" href="#">/ Newsflash 8 /</a>	<i> — Monday, February 15, 2010 12:42</i></div>
	                            <h4>Content of Newsflash 8</h4>
	                            <p>Joomla! 1.5 - 'Experience the Freedom'!. It has never been easier to create your own dynamic Web...
	                                <a class="readmore" href="#">Read more </a>
	                            </p>
	                         </div>
                    </li> 
                  </ul> 
              </div>
           	<div class="navigator-content">
                  <div class="button-control"><span></span></div>	
                  <div class="navigator-wrapper">
                        <ul class="navigator-wrap-inner">
                           <li><span>1</span></li>
                           <li><span>2</span></li>
                           <li><span>3</span></li>
                           <li><span>4</span></li>    
                           <li><span>5</span></li>
                           <li><span>6</span></li>       
                           <li><span>7</span></li>       
                           <li><span>8</span></li>          		
                        </ul>
                  </div>
             </div>
 </div>
			<?php }?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
	</footer>
	</section>
</body>
</html>