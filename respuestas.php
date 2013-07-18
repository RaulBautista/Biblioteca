<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Respuestas</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="css/codemirror.css">
	<link rel="stylesheet" href="css/solarized.css">
	<link rel="stylesheet" href="css/shCoreDefault.css">
	<style type="text/css">
      .CodeMirror { border: 1px solid silver; height: auto;}
      /*.CodeMirror-empty { outline: 1px solid #c22; }*/
      .CodeMirror-empty.CodeMirror-focused { outline: none; }
      .CodeMirror pre.CodeMirror-placeholder { color: #999; }
    </style>
	<script type="text/javascript" src="js/new/jquery-1.9.1.min.js"></script>
	<script src="js/new/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/es.js"></script>
	<script type="text/javascript" src="js/syntax/scripts/shCore.js"></script>
	<script type="text/javascript" src="js/syntax/shAutoloader.js"></script>
	<script type="text/javascript" src="js/syntax/scripts/shBrushXml.js"></script>
	<!--Codemirror -->
	<script src="js/codemirror/codemirror.js"></script>
	<script src="js/codemirror/edit/closetag.js"></script>
	<script src="js/codemirror/xml.js"></script>
	<script src="js/codemirror/javascript.js"></script>
	<script src="js/codemirror/php.js"></script>
	<script src="js/codemirror/css.js"></script>
	<script src="js/codemirror/clike.js"></script>
	<script src="js/codemirror/htmlmixed.js"></script>
	<script src="js/jquery.autosize-min.js"></script>
	<script>
		$(document).on('ready', function(){
			function path()
			{
			  var args = arguments,
			      result = []
			      ;
			       
			  for(var i = 0; i < args.length; i++)
			      result.push(args[i].replace('@', 'js/syntax/scripts/'));
			       
			  return result
			};
			 
			SyntaxHighlighter.autoloader.apply(null, path(
			  'applescript            @shBrushAppleScript.js',
			  'actionscript3 as3      @shBrushAS3.js',
			  'bash shell             @shBrushBash.js',
			  'coldfusion cf          @shBrushColdFusion.js',
			  'cpp c                  @shBrushCpp.js',
			  'c# c-sharp csharp      @shBrushCSharp.js',
			  'css                    @shBrushCss.js',
			  'delphi pascal          @shBrushDelphi.js',
			  'diff patch pas         @shBrushDiff.js',
			  'erl erlang             @shBrushErlang.js',
			  'groovy                 @shBrushGroovy.js',
			  'java                   @shBrushJava.js',
			  'jfx javafx             @shBrushJavaFX.js',
			  'js jscript javascript  @shBrushJScript.js',
			  'perl pl                @shBrushPerl.js',
			  'php                    @shBrushPhp.js',
			  'text plain             @shBrushPlain.js',
			  'py python              @shBrushPython.js',
			  'ruby rails ror rb      @shBrushRuby.js',
			  'sass scss              @shBrushSass.js',
			  'scala                  @shBrushScala.js',
			  'sql                    @shBrushSql.js',
			  'vb vbnet               @shBrushVb.js',
			  'html                   @shBrushXml.js'
			));
			SyntaxHighlighter.all();

			$('.animated').autosize({append: "\n"});
			$( "#tabs" ).tabs();

			$('#respuesta').keydown(function(e){
				var maxChars = 499;
				if($(this).val().length <= maxChars){
					var charsLeft = ( maxChars - $(this).val().length );
					$('#contador').text( charsLeft + ' caracteres restantes.' ).css('color', (charsLeft<10)?'#F00':'#000' );
				}else{
					return ($.inArray(e.keyCode,[8,35,36,37,38,39,40]) !== -1);
				}
			});
		});
	</script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">			
		<?php include("includes/menu.php");?>
	</header>
	<section class="contenedor">
		<?php
		error_reporting(E_ALL & ~E_NOTICE);  
		session_start();
		//date_default_timezone_set('America/Los_Angeles');
		date_default_timezone_set('America/Mexico_City');		
		if($_SESSION['logged'] == '1') { 
			include "includes/menualumno.php";
			require_once("includes/conexion.php");
			$id = $_GET['id'];
			$consulta = @mysql_query('SELECT * FROM Preguntas WHERE id = "'.mysql_real_escape_string($id).'"')
			or die (mysql_error()); 
			$row = mysql_fetch_array($consulta);
			printf("
			<br>
			<article id='pregunta_res'>
				<h1>%s</h1>
				<p>Posteado por: %s || %s</p><br>
				<p id='problema'>%s</p><br>				
			</article>				
				", 
			$row["pregunta"], $row["autor"], date("j M Y - g:i A ", strtotime($row["fecha"])), nl2br(htmlspecialchars($row["mensaje"])));
			$nombre = $_SESSION['user'];
			?>
			<?php
			?>
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Texto</a></li>					
					<li><a href="#tabs-2">Código</a></li>
				</ul>
				<div id="tabs-1">
				<form method="POST" action="responder.php" id="FormRespuesta">
					<textarea name="respuesta" id="respuesta" class="animated" placeholder="Publica aqui tus comentarios... <img src=' '> <iframe src=' '></iframe>" ></textarea>
					<input type="hidden" name="autor" value="<?php echo $nombre ?>"/>
					<input type="hidden" name="id" value="<?php echo $id ?>"/>
					<input type="submit" id="boton" value="Publica tu respuesta" class="boton2"/>
					<div id="contador"></div>	
				</form>			
				</div>				
				 <div id="tabs-2">	
				 <form method="POST" action="responder.php" id="FormRespuesta">			 	
				 	<textarea id="code" name="respuesta">

</textarea>
				 	<input type="hidden" name="autor" value="<?php echo $nombre ?>"/>
					<input type="hidden" name="id" value="<?php echo $id ?>"/>
					<input type="hidden" name="control" value="1"/>
					<input type="submit" id="boton" value="Publica tu codigo" class="boton2"/>
				</form>
				</div>								
			</div>
			<script type="text/javascript">
				var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
				lineNumbers: true,
				//mode: 'text/html',
				mode: 'application/x-httpd-php',
				theme: 'solarized',
				indentUnit: 4,
				viewportMargin: Infinity,
				indentWithTabs: true,
				autoCloseTags: true
				});
    		</script>
			<hr size='4'/ class="division">
			<?php
			$consulta = @mysql_query('SELECT * FROM Respuestas WHERE id_pregunta = "'.mysql_real_escape_string($id).'" ORDER BY fecha DESC')
			or die (mysql_error()); 
			//$num_respuestas = mysql_num_rows($consulta);
			while ($row = mysql_fetch_array($consulta)) {
			if ($row['control'] == "1") {
				$res = htmlspecialchars($row["respuesta"]);
				printf("<article class='respuetas_alumnos'>
					<div class='autor'>
						<p>%s || %s</p>
					</div>
					<hr size='3'><br>
					<div class='msg_respuesta'>						
					<pre class='brush: php; html-script: true'>%s</pre>
					</div><br>
					<a href='#'><img src='img/corazon.png' class='voto'></a>
				</article><br>
				",   
				$row['autor'],date("j M Y - g:i:s A ", strtotime($row["fecha"])) , $res);
			}
			else{
				$res = strip_tags($row["respuesta"],'<iframe><img>'); //segundo parametro etiquetas que permite							
				printf("<article class='respuetas_alumnos'>
					<div class='autor'>
						<p>%s || %s</p>
					</div>
					<hr size='3'><br>
					<div class='msg_respuesta'>						
						<p>%s</p>			
					</div>
					<a href='#'><img src='img/corazon.png' class='voto'></a>
				</article><br>
				",   
				$row['autor'],date("j M Y - g:i:s A ", strtotime($row["fecha"])) , nl2br($res));
			}			
				// nl2br(htmlspecialchars($row["respuesta"]))); .... nl2br(strip_tags($row["respuesta"], '<iframe><img>')));
			}																		
		//nl2br($cadena_de_texto);
		mysql_free_result($consulta);
		mysql_close($link); ?>
		<a href="foro.php" class="boton">Regresar al foro</a>
		<?php }else{
			header("Location: index.php");
		} ?>
	</section>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>