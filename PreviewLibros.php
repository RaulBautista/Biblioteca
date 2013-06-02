<?php
	require_once('conexion.php');
	$result=mysql_query("SELECT * FROM Libros", $link);
?>
	<TABLE id="tabla" border=1 CELLSPACING=1 CELLPADDING=1 >
	<thead>
		<TR>
			<th>ID</th>
			<TH>Autor</TH>
			<TH>Titulo</TH>
			<TH>Edicion</TH>
			<TH>Editorial</TH>
			<TH>Num. de Paginas</TH>
			<TH>Serie o Coleccion</TH>
			<th></th>
		</TR>
	</thead>
<?php
	while ($row = mysql_fetch_array($result)) {

		printf("<tr><td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>					
					<td>
						<a href='ConsultaCompleta.php?id=$row[id_libro]' id='btn-consulta'>Ver Mas Informacion</a>
					</td>							
				</tr>", 
				$row["id_libro"], $row["autor"], $row["titulo"], $row["edicion"], $row["editorial"], $row["num_paginas"], $row["coleccion"]);
	}
	mysql_free_result($result);

	mysql_close($link);

?>
	</TABLE>