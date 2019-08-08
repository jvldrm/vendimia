<?php



session_start();




include("portada.php");


$q_str = "select max(id) as maximo from ventas";

$result = $conn->query($q_str);

$row = $result->fetch_assoc();

$_SESSION['numero_de_venta'] = $row['maximo'] + 1;




?>





<div class="container" >
	<div style="text-align: right">
	<form action="registro_ventas.php" method="post">
	<button type="submit" class="btn btn-primary"> 
		<span class="glyphicon glyphicon-plus-sign" style="font-size: 2em; color: #14c741;"></span> Nueva Venta 
	</button>
	</form>
</div>

	<table class="table" > 
		<thead> 
			<tr>
				<td colspan="6" style="color: #2cbfc9">
					Ventas activas
				</td>
			</tr>
			<tr style="background-color: #a695de; color: #4e2cbf">
				<td> Folio Venta </td>
				<td> Clave Cliente </td>
				<td> Nombre </td>
				<td> Total </td>
				<td> Fecha </td>
				<td> Estatus </td>
			</tr>
		</thead>

		


		<?php

		$res_ventas = $conn->query('select * from ventas');

		while( $row_v = $res_ventas->fetch_assoc() ){
			echo "<tr>
			<td> ". $row_v['id']  ." </td><td> ". $row_v['clavecliente'] ." </td><td> ". $row_v['nombre'] ." </td><td>". $row_v['total'] ." </td><td> ". $row_v['fecha'] ." </td><td> ". $row_v['estatus'] ." </td>
			</tr>";
		}

		?>



	</table>



</div>




</body>
</html>



