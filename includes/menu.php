<?php 
error_reporting(E_ALL & ~E_NOTICE); //Oculta errores
if($_SESSION['logged'] == '1'){
	$nombre = $_SESSION['user'];
 	$loged=substr($nombre,0,12); 
?>
<link rel="stylesheet" href="css/menualumno.css">
<nav>
   <ul class="ul">
     <li><a href="index.php">Inicio</a></li>
     <li><a href="acerca.php">Acerca de</a></li>     
     <li><a href="Busqueda.php">Contactanos</a></li>
     <li><a href="#"><?php echo $loged ?></a>
        <ul>
            <li><a href="alumno.php">Panel</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="articulos.php">Articulos</a></li>
            <li><a href="foro.php">Foro</a></li>
            <li><a href="includes/Logout.php">Salir</a></li>
        </ul>
     </li>
   </ul>
</nav>

<script type="text/javascript">
	$(document).ready(function(){
		// Muestra y oculta los menús
	   	$('.ul li:has(ul)').hover(
	 	function(e)
	 	{
	 	$(this).find('ul').css({display: "block"});	 	
	 	},
		function(e)
	 	{
	 	$(this).find('ul').css({display: "none"});	 	
	 	}
	 	);
	});
</script>
<?php }else{?>
<nav class="menu">
   <ul>
     <li><a href="index.php">Inicio</a></li>
     <li><a href="acerca.php">Acerca de</a></li>
     <li><a href="Busqueda.php">Busqueda y Contacto</a></li>
     <li><a href="colecciones.php">Ingresa</a></li>
   </ul>
</nav>
<?php } ?>