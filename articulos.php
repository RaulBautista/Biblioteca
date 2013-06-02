<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Articulos</title>
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" href="css/dropzone.css">
	<link rel="stylesheet" href="css/tabla.css">
	<script src = "js/new/dropzone.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript">
	$(function() {
		$(".vote").click(function() {
		var id = $(this).attr("id");
		var name = $(this).attr("name");
		var dataString = 'id='+ id ;
		var parent = $(this);

		if(name=='up'){
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
		}else{
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
		return false;
		});

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
		<?php
		error_reporting(E_ALL & ~E_NOTICE);
		session_start();
		if($_SESSION['logged'] == '1') { 
		include "includes/menualumno.php";
		echo "<p id='bienvenido'>Bienvenido <strong>$_SESSION[user]</strong> aqui puedes subir tus articulos en formato PDF y votar el que mas te guste</p><br>"
		?>

		<form action="upload.php" class="dropzone">
  			<div class="fallback">
    			<input name="file" type="file" />
  			</div>
		</form>
		<article id="articulos">
			<?php
			require "includes/conexion.php";
			$result = mysql_query("SELECT * FROM Articulos");
			?>
			<table id="datatables" class="display">
        <thead>
		<TR>
			<th>No.</th>
			<th>Titulo</th>
			<th>Autor</th>
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
                            <td><a href="#" onclick="window.open('<?=$row['ruta']?>')">Abrir archivo pdf</a></td>
                            <td id="votedown"><a href="" class="vote" id="<?php echo $row['id']; ?>" name="down"><?php echo $row['down']; ?></a></td>
                            <td id="voteup"><a href="" class="vote" id="<?php echo $row['id']; ?>" name="up"><?php echo $row['up']; ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
		</article>
		 <!--<input type="button" value="Abrir archivo pdf" onclick="window.open('uploads/1.pdf')" />
		 <a href="#" onclick="window.open('uploads/1.pdf')">Abrir archivo pdf</a>
		-->
		<?php } ?>
		<footer>
			<p>Calle 25 de Septiembre de 1873, Col. Leyes de Reforma S/N, Delegación Iztapalapa, México D.F. C.P. 09310.</p>
		</footer>
	</section>
</body>
</html>