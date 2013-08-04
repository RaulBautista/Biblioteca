<!doctype html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Articulos</title>
	<link rel="stylesheet" href="css/design2.css">
	<link rel="stylesheet" href="css/tabla.css">
	<link rel='stylesheet' href='css/toastmessage.css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src='js/new/jquery.toastmessage.js'></script>
	<script src="js/new/jquery-ui-1.10.3.custom.min.js"></script>
	<script type="text/javascript">
	$(function() {
		$(".vote").click(function() {
		var id = $(this).attr("id");
		var name = $(this).attr("name");
		var dataString = 'id='+ id ;
		var parent = $(this);
		if(name=='up'){
			var r = confirm("¿Deseas dar un voto positivo a este articulo?")
			if (r == true){
			$(this).fadeIn(200).html('...');
			$.ajax({
   				type: "POST",
   				url: "includes/up_vote.php",
   				data: dataString,
   				cache: false,
   				success: function(html){
    				parent.html(html);
  				}  
  			});
			}
		}else{
			var r = confirm("¿Deseas dar un voto negativo a este articulo?")
			if (r == true){
			$(this).fadeIn(200).html('...');
			$.ajax({
   				type: "POST",
   				url: "includes/down_vote.php",
		   		data: dataString,
		   		cache: false,
   				success: function(html){
       				parent.html(html);
  				}
 			});
			}
		}
		return false;
		});

	});
	</script>
</head>
<body>
	<header>
		<img src="img/logo_mini.png" alt="tec">		
		<?php session_start(); error_reporting(E_ALL & ~E_NOTICE); if($_SESSION['logged'] == '1') {  include("includes/menualumno.php") ?>
	</header>
	<section class="contenedor">
		<?php		
		echo "<p id='bienvenido'>Aqui puedes compartir archivos en formato PDF.<br></p><hr><br>"
		?>
		<!--Drop Zone -->

		<!-- End drop zone -->
		<div class="exito"></div>
		<article id="articulos">
		<?php
			require "includes/conexion.php";
			$result = mysql_query("SELECT * FROM Articulos");
			$num = mysql_num_rows($result);
			if ($num == 0) {
				echo "<p class='bienvenido'>No hay articulos aun</p>";
			}else{
			?>
			<table id="datatables" class="display">
        <thead>
		<TR>
			<th>No.</th>
			<th>Titulo</th>
			<th>Subido por</th>
			<th>Enlace</th>
			<th><img src="img/dislike2.png" alt="dislike"></th>
			<th><img src="img/like2.png" alt="like"></th>
		</TR>
	</thead>
                <tbody>
                    <?php
                    $contador = 0;                    
                    while ($row = mysql_fetch_array($result)) {
                    	$contador ++;             
                        ?>
                        <tr>
                            <td><?=$contador?></td>
                            <td><?=$row['titulo']?></td>
                            <td><?=$row['autor']?></td>                                                   
                            <td><a href="#" onclick="window.open('<?=$row['ruta']?>')"><img src="img/pdf.png" alt="PDF" width="30px"> </a></td>
                            <td id="votedown"><a href="" class="vote" id="<?php echo $row['id']; ?>" name="down"><?php echo $row['down']; ?></a></td>
                            <td id="voteup"><a href="" class="vote" id="<?php echo $row['id']; ?>" name="up"><?php echo $row['up']; ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php } ?>
		</article>
		 <!--<input type="button" value="Abrir archivo pdf" onclick="window.open('uploads/1.pdf')" />
		 <a href="#" onclick="window.open('uploads/1.pdf')">Abrir archivo pdf</a>
		-->
		<?php }else{
			header("location: colecciones.php");
		} ?>
	</section><br>
	<footer>
		<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		<a href="https://www.facebook.com/Xnour" target="_blank"><img src="img/face.jpeg" alt="Facebook" class="facebook"></a>
	</footer>
</body>
</html>