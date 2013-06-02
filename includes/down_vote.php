<?php
session_start();
include("conexion.php");
//$ip=$_SERVER['REMOTE_ADDR'];
if($_POST['id']){
	$id=$_POST['id'];
	$autor = $_SESSION['user'];
	$id = mysql_real_escape_string($id);
	//Verify IP address in Voting_IP table
	//$ip_sql=mysql_query("SELECT ip_add from Ip where id='$id' and ip_add='$ip'");
	$votador = mysql_query("SELECT votador from Voto WHERE id_articulo = '$id' and votador = '$autor'", $link);
	$count=mysql_num_rows($votador);
	if($count==0){
		// Update Vote.
		$sql = "UPDATE Articulos set down = down + 1 where id='$id'";
		mysql_query( $sql,$link);
		// Insert IP address and Message Id in Voting_IP table.
		//$sql_in = "INSERT into Ip (id_articulo,ip_add) values ('$id','$ip')";
		//mysql_query( $sql_in);
		$query = mysql_query("INSERT INTO Voto (id_articulo, votador) values ('$id', '$autor')", $link);
		echo "<script>alert('Gracias por tu voto negativo! :(');</script>";
	}else{
		echo "<script>alert('Ya has votado este articulo!');</script>";
	}
	$result=mysql_query("SELECT down from Articulos where id='$id'",$link);
	$row=mysql_fetch_array($result);
	$down_value=$row['down'];
	echo $down_value;
}
?>