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
	<link rel="stylesheet" href="css/liveurl.css">	
	<style type="text/css">
      .CodeMirror { border: 1px solid silver; height: auto;}
      .CodeMirror-empty { outline: 1px solid #c22; }
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
	<script src="js/codemirror/placeholder.js"></script>
	<script src="js/codemirror/xml.js"></script>
	<script src="js/codemirror/javascript.js"></script>
	<script src="js/codemirror/php.js"></script>
	<script src="js/codemirror/css.js"></script>
	<script src="js/codemirror/clike.js"></script>
	<script src="js/codemirror/htmlmixed.js"></script>
	<script src="js/jquery.autosize-min.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/es.js"></script>
	<script src="js/respuestas.js"></script>
	<script src="js/jquery.liveurl.js"></script>	

	<script>
	function votar(idp){        
	    	$.ajax({	    	
	        url: "includes/votarRespuesta.php",
	        async: false,
	        type: 'POST',
	        data: {id: idp},
	        dataType: "json",
	        beforeSend: function(){                
	            $('.'+idp).html('<img src="img/load.gif" alt="...">').delay(100);
	        },
	        success: function(data){	        	
	            $.each(data, function(c, v){
	            	var eImagen = v.voto;
	                var idr = v.id;
	                var imagen = $('.imagen'+idr);
	            	if(eImagen == 0){	            		
	            		imagen.attr('src', 'img/corazon.png');
	            		imagen.hide().slideDown(500);

	            	}else{
	            		imagen.attr('src', 'img/corazon2.png');
	            		imagen.hide().slideDown(500);
	            	}
	                $('.'+idr).text(v.valor);
	            });
	        },
	        error: function (xhr, ajaxOptions, thrownError) {                
	        console.log(xhr.status);
	        console.log(thrownError);                               
	        } 
    		})
    };
	</script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">			
		<?php session_start(); include("includes/menu.php"); if($_SESSION['logged'] == '1') { ?>
	</header>
	<section class="contenedorRespuestas">
		<?php		
		date_default_timezone_set('America/Mexico_City');			
			require_once("includes/conexion.php");
			$id = $_GET['id'];
			$nombre = $_SESSION['user'];
		?>
		<script>
		var id = <?php echo $id?>;
		</script>
		<!--Pregunta -->
		<br>
		<article id='pregunta_res'></article>
		<!--Textarea-->
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Texto</a></li>		
					<li><a href="#tabs-2">Código</a></li>					
				</ul>
				<div id="tabs-1">
				<form class="formRespuesta">
					<textarea name="respuesta" class="animated respuesta" placeholder="Publica aqui tus comentarios..."></textarea>
					<div class="liveurl-loader"></div>
					<div class="liveurl">
			            <div class="close" title="Entfernen"></div>
			            <div class="inner">
			                <div class="image"> </div>
			                <div class="details">
			                    <div class="info">
			                        <div class="title"> </div>
			                        <div class="description"> </div> 
			                        <div class="url"> </div>
			                    </div>
			                    <div class="thumbnail">
			                        <div class="pictures">
			                            <div class="controls">
			                                <div class="prev button inactive"></div>
			                                <div class="next button inactive"></div>
			                                <div class="count">
			                                    <span class="current">0</span><span> de </span><span class="max">0</span>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="video"></div>
			                </div>

			            </div>
			        </div><!-- -->
					<input type="hidden" name="autor" class="autor" value="<?php echo $nombre ?>"/>
					<input type="hidden" name="id" class="id" value="<?php echo $id ?>"/>
					<input type="hidden" name="control" class="control" value="0"/>
					<input type="submit" id="boton" value="Publica tu comentario" class="boton2"/>
					<div id="contador_resp"></div>	
					<div class='mensajes_load'></div>			
				</form>			
				</div>				
				 <div id="tabs-2">	
				 <form class="formRespuesta2">			 	
				 	<textarea id="code" name="respuesta" class="respuesta2" placeholder="Limita tu codigo a 650 caracteres..."></textarea>
				 	<input type="hidden" name="autor" class="autor2" value="<?php echo $nombre ?>"/>
					<input type="hidden" name="id" class="id2" value="<?php echo $id ?>"/>
					<input type="hidden" name="control" class="control2" value="1"/>
					<input type="submit" id="boton" value="Publica tu codigo" class="boton2"/>					
					<div class='mensajes_load'></div>
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
				//
    		</script>
    		<div class="total_resp"><hr size="6"><br></div>
    		<article class="add_resp"></article>    		
			<a href="foro.php" class="boton" id="botonRespuestas">Regresar al foro</a>
			<div class="subir"><img src="img/up.png" alt="subir"></div>
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