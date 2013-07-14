<?php
$nombre = $_SESSION['user'];
 $loged=substr($nombre,0,12); 
?>
<link rel="stylesheet" href="css/menualumno.css">
<div class="click-nav">
	<ul class="no-js">
		<li>
			<a class="clicker"><img src="img/i-1.png" alt="Icon"><?php echo $loged."...";  ?></a>
				<ul>
					<li><a href="alumno.php"><img src="img/i-2.png" alt="Icon">Inicio</a></li>					
					<li><a href="libros.php"><img src="img/i-2.png" alt="Icon">Libros</a></li>
					<li><a href="articulos.php"><img src="img/i-4.png" alt="Icon">Articulos</a></li>
					<li><a href="foro.php"><img src="img/i-5.png" alt="Icon">Foro</a></li>
					<li><a href="includes/Logout.php"><img src="img/i-6.png" alt="Icon">Salir</a></li>
				</ul>
		</li>
	</ul>
</div>
	<script>
		$(function() {
			// Clickable Dropdown
			$('.click-nav > ul').toggleClass('no-js js');
			$('.click-nav .js ul').hide();
			$('.click-nav .js').click(function(e) {
				$('.click-nav .js ul').slideToggle(200);
				$('.clicker').toggleClass('active');
				e.stopPropagation();
			});
			$(document).click(function() {
				if ($('.click-nav .js ul').is(':visible')) {
					$('.click-nav .js ul', this).slideUp();
					$('.clicker').removeClass('active');
				}
			});
		});
	</script>