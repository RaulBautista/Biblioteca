<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Biblioteca</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" type="text/css" href="css/slideindex.css">
	<link rel="stylesheet" href="css/apprise-v2.css">
	<!--[if IE]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js&quot; type="text/javascript"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/ie7-squish.js&quot; type="text/javascript"></script>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js&quot; type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="js/new/apprise-v2.js"></script>
	<script type="text/javascript" src="js/new/jquery-ui-1.9.2.custom.min.js"></script>
	<script>
		$(document).ready(function(){
		//Apprise('Pagina en construccion!. Cualquier sugerencia por favor hacerla al correo <a target="_blank" href="https://www.facebook.com/Xnour">raul_nouni@hotmail.com</a>');
		//$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
		});
	</script>	
</head>
<body>
	<section class="contenedor">
		<header>
			<img src="img/logos.png" alt="tec">
			<h1>Instituto Tecnologico De Iztapalapa II<br>Biblioteca</h1>
			<?php include("includes/menu.php"); ?>	
		</header>
		<section>
			<div id="featured">
				<ul class="ui-tabs-nav">
			    	<li class="ui-tabs-nav-item" id="nav-fragment-1"><a href="#fragment-1"><img src="img/images/biblioteca1_small.png" alt="" max-width="700px"/><span>Bienvenido</span></a></li>
			        <li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2"><img src="img/images/biblioteca2_small.png" alt="" max-width="700px"/><span>Visita la pagina del ITI2</span></a></li>
			        <li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3"><img src="img/images/biblioteca3_small.png" alt="" max-width="700px"/><span>Avisos</span></a></li>
			        <li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4"><img src="img/images/biblioteca4_small.png" alt="" max-width="700px"/><span>Novedades</span></a></li>
			    </ul>

		    <!-- First Content -->
			    <div id="fragment-1" class="ui-tabs-panel">
					<img src="img/images/biblioteca1.png" alt="Biblioteca" id="imagenIndex" />
					 <div class="info" >
						<h2>Bienvenidos</h2>
						<p>Aqui encontraras informacion de libros con los que cuenta el instituto  <a href="colecciones.php" >Ingresa ya</a></p>
					 </div>
			    </div>

		    <!-- Second Content -->
			    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" >
					<img src="img/images/biblioteca2.png" alt="" id="imagenIndex" />
					 <div class="info" >
						<h2><a href="#" >Instituto Tecnologico de Iztapalapa II</a></h2>
						<p>Visitia la pagina Oficial del Instituto Tecnologico de Iztapalapa II  <a href="http://www.itiztapalapa2.edu.mx/" >Visitar la pagina</a></p>
					 </div>
			    </div>

			<!-- Third Content -->
			    <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" >
					<img src="img/images/biblioteca3.png" alt="" id="imagenIndex" />
					 <div class="info" >
						<h2>Proximamente</h2>
						<p>Aqui encontraras avisos referentes a la biblioteca</p>
			         </div>
			    </div>

		    <!-- Fourth Content -->
			    <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" >
					<img src="img/images/biblioteca4.png" alt="" id="imagenIndex" />
					 <div class="info" >
						<h2>Programacion Web</h2>
						<p>Ya contamos con nuevos libros sobre programacion web. Visita la Biblioteca</p>
			         </div>
			    </div>	
			</div>
		</div>
		</section>		
		<aside>
			<a href="http://www.sep.gob.mx/"><img src="img/sep.gif" alt="sep"></a>
			<a href="http://www.dgit.gob.mx/"><img src="img/dgest.png" alt="dgest"></a>
			<a href="http://www.tecnologicosdf.mx/"><img src="img/SEP_IT.png" alt="sep"></a>
		</aside>
		<footer>
			<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
			<a href="https://www.facebook.com/Xnour"><img src="img/facebook.png" alt="Redes Sociales"></a>
		</footer>
	</section>
</body>
</html>