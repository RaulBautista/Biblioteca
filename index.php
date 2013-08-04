<!DOCTYPE HTML>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Biblioteca</title>
	<link rel="stylesheet" href="css/design2.css">	
	<link rel="stylesheet" href="css/apprise-v2.css">
	<!--[if IE]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>		
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js&quot; type="text/javascript"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/ie7-squish.js&quot; type="text/javascript"></script>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js&quot; type="text/javascript"></script>
	<![endif]-->
	<script type="text/javascript" src="js/new/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/new/apprise-v2.js"></script>
	<script>
		$(document).ready(function(){
    	//if( $.browser.webkit ) alert('Si la pagina no se visualiza bien, intenta con otro navegador (Chrome, Firefox u Opera)');
    	//B. El navegador es Internet Explorer, pero con versión superior a la 6
    	if ($.browser.msie && $.browser.version > 6 ) alert('Te recomendamos cambiar de navegador para ver mejor esta aplicación web. Cambiate a Chrome, Firefox u Opera');
    	//C. El navegador es Internet Explorer, pero con versión inferior o igual a la 6
    	if ($.browser.msie && $.browser.version <= 6 ) alert('Te recomendamos cambiar de navegador para ver mejor esta aplicación web. Cambiate a Chrome, Firefox u Opera');
    	//D. El navegador es Mozilla Firefox en versión 2 o superior
    	if ($.browser.mozilla && $.browser.version <= "1.8" ) alert('Actualiza tu navegador para seguir navegando en esta pagina');
    	});
	</script>	
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">			
		<?php include("includes/menu.php"); ?>	
	</header>
	<section class="contenedor">
		<section>

		</section>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<div class="facebook"><a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook"></a></div>
		<a href="http://www.sep.gob.mx/"><img src="img/sep.gif" alt="sep" class="img_footer"></a>
		<a href="http://www.dgit.gob.mx/"><img src="img/dgest.png" alt="dgest" class="img_footer"></a>
		<a href="http://www.tecnologicosdf.mx/"><img src="img/SEP_IT.png" alt="sep" class="img_footer"></a>
	</footer>
</body>
</html>