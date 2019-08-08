<?php
session_start();

include("portada.php");




?>





<div class="container" >

	<table class="table" > 
		<thead> 
			<tr>
				<td colspan="5" style="color: #2cbfc9">
				Articulos
					</td>
			</tr>
			<tr style="background-color: #a695de; color: #4e2cbf">
				<td> Clave de articulo </td>
				<td> Descripcion </td>
				<td> Modelo </td>
				<td> Precio </td>
				<td> Existencia </td>

			</tr>
		</thead>

		


		<?php

		$res_ventas = $conn->query('select * from articulos');

		while( $row_v = $res_ventas->fetch_assoc() ){
			echo "<tr>
			<td> ". $row_v['id']  ." </td><td> ". $row_v['descripcion']  ." </td><td> ". $row_v['modelo'] ." </td> <td> ". $row_v['precio'] ." </td> <td> " . $row_v['existencia'] . "</td> 
			</tr>";
		}

		?>



	</table>



</div>




</body>
</html>

