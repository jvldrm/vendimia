<?php
session_start();

include("portada.php");



?>

<script>


	var tasa = <?php

            if( isset( $_SESSION['tasa'] ) ){
              echo $_SESSION['tasa'];
            } else {
              echo 10;
            }
          ?> ;


var enganche = <?php

            if( isset( $_SESSION['enganche'] ) ){
              echo $_SESSION['enganche'];
            } else {
              echo 0;
            }
          ?> ;

var plazo = <?php

            if( isset( $_SESSION['plazo'] ) ){
              echo $_SESSION['plazo'];
            } else {
              echo 0;
            }
          ?> ;



	$( function() {



		// colocar valores default de la configuracion
		$("#tasa").val(tasa);
		$("#enganche").val(enganche);
		$("#plazo").val(plazo);


		$("#boton_guarda").click(function(){

			var tasa = $("#tasa").val();
			var enganche = $("#enganche").val();
			var plazo = $("#plazo").val();

			$.post("guardar_datos.php",

					{
						tasa:tasa,
						enganche:enganche,
						plazo:plazo
					},

					function(data, status){
						alert("Data:" + data);
					}

					);

			//alert("quiere guardar" + tasa + enganche + plazo);

		});

	});

</script>

<div class="container">

	<div class="panel panel-primary">

		<div class="panel-heading"> Configuracion </div>
		<div class="panel-body"> 
			<table style="margin-top: 5%; margin-left: 5%">
				<tr> 
					<td align="right">  Tasa Financiamiento: </td>
					<td> <input type="text" size="7" id="tasa"> </td>
				</tr>
				<tr> 
					<td align="right" >  % Enganche: </td>
					<td> <input type="text" size="7" id="enganche"> </td>
				</tr>
				<tr> 
					<td align="right">  Plazo Maximo: </td>
					<td> <input type="text" size="7"  id="plazo"> </td>
				</tr>
			</table>
		</div>


	</div>

	<div style="text-align: right">
				<button type="button" class="btn btn-success">Cancelar</button>

		<button type="button" class="btn btn-success" id="boton_guarda">Guardar</button>
	</div>


</div>



</body>
</html>




