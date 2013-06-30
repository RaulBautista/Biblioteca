<?php
session_start();
if ($_SESSION['logged'] == '1') {
include("conexion.php");
if($_POST['id']){
	$id=$_POST['id'];
	$autor = $_SESSION['user'];
	$id = mysql_real_escape_string($id);
	$votador = mysql_query("SELECT votador from Voto WHERE id_articulo = '$id' and votador = '$autor'", $link);
	$count=mysql_num_rows($votador);
	if($count == 0){		
		$sql = "UPDATE Articulos set down = down + 1 where id='$id'";
		mysql_query($sql,$link);
		$query = mysql_query("INSERT INTO Voto (id_articulo, votador) values ('$id', '$autor')", $link);
		echo "<script>alert('Lamentamos tu voto negativo! :(');</script>";
	}else{		
		echo "<script>alert('Ya has votado este articulo!');</script>";
	}
	$result=mysql_query("SELECT down from Articulos where id='$id'",$link);
	$row=mysql_fetch_array($result);
	$down_value=$row['down'];
	echo $down_value;
}
}else{
	header("location: ../index.php");
}
?>