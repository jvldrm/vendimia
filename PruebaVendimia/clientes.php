<?php
session_start();

include("portada.php");




?>





<div class="container" >
	
	<table class="table" > 
		<thead> 
			<tr>
				<td colspan="3" style="color: #2cbfc9">
				Clientes
					</td>
			</tr>
			<tr style="background-color: #a695de; color: #4e2cbf">
				<td> Clave de usuario </td>
				<td> Nombre </td>
				<td> RFC </td>
			</tr>
		</thead>

		


		<?php

		$res_ventas = $conn->query('select * from clientes');

		while( $row_v = $res_ventas->fetch_assoc() ){
			echo "<tr>
			<td> ". $row_v['id']  ." </td><td> ". $row_v['nombre'] ." ".  $row_v['apellido_paterno'] ." ". $row_v['apellido_materno'] ." </td><td> ". $row_v['rfc'] ." </td>
			</tr>";
		}

		?>



	</table>



</div>




</body>
</html>


