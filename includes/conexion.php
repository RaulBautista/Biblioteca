<?php
function conectarse()
{
	if(!($link=mysql_connect("localhost", "root", "Xnour")))
	{
		echo "Error De Conexion A La Base De Datos";
		exit();
	}
	if(!mysql_select_db("Biblioteca", $link))
	{
		echo "Error Al Seleccionar La Base De Datos";
		exit();
	}
	return $link;
}

$link = conectarse();
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'",$link); 
//echo "Conexion Exitosa Con La BD.<br>";
?>