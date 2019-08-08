<?php
session_start();

include("portada.php");


?>

<style>
    table.borderless td,table.borderless th{
     border: none !important;
    }

</style>


<script>

  var clave_cliente = "";
  var modo_sig_guardar = 0;
var data=[];
var total_adeudo = 0;
 var detalles_articulo = {descripcion:"aa", modelo:"bb", precio:"cc", existencia:"dd"};

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


  var numero_de_renglones = 0;

  function borrador(renglon){

    $("#renglon_" + renglon).remove();
    sumadora();
  }

  function colocar_cantidad(precio, renglon){
    var cantidad = $("#cantidad_" + renglon).val();

    if( cantidad == "") {
      cantidad = 0;
    }

    var importe = cantidad * precio;

    if( parseInt(cantidad) <= parseInt(detalles_articulo.existencia)){
      $("#importe_"+renglon).text(importe);
      $("#alertas").html("");
      sumadora();
    } else {
      $("#cantidad_" + renglon).val("1");
      $("#alertas").html(' <div class="alert alert-danger"> Excede la cantidad de articulos de este tipo en existencia. </div>  ');
      $("#importe_"+ renglon).text(  $("#precio_alt_"+renglon).text   );  // obtener el valor de la celda del precio correspondiente
    }

  }

  function sumadora(){
    var data=[];

    $("#tabla_articulos").find('tr').each(function (rowIndex, r) {

      var cols=[];
      $(this).find('td').each(function (colIndex, c) {
        cols.push(c.textContent);
      });

      data.push(cols);

    });



    var sum = 0;
    var i;
    for (i=1; i < data.length; i++){

      sum = sum + parseFloat( data[i][4] );

    }

    sum = sum.toFixed(2);

   // alert("suma es " + sum);

   enganche_tot = enganche / 100 * sum;

   bonificacion_tot = enganche_tot * tasa * plazo / 100;

   total_adeudo = sum - enganche_tot - bonificacion_tot ;

   $("#td_enganche").text( enganche_tot.toFixed(2) );

   $("#td_bonificacion").text(  bonificacion_tot.toFixed(2) );

    $("#td_total").text( total_adeudo.toFixed(2)  );


    return sum;

  }





  $( function() {
  
    $( "#input_cliente" ).autocomplete({
      source: "search.php",
      minLength: 3,
      select: function( event, ui ) {
        $("#dato_rfc").text( ui.item.rfc);

        clave_cliente = ui.item.clave_cliente;
      }
    });


   $( "#input_articulo" ).autocomplete({
      source: "search2.php",
      minLength: 3,
      select: function( event, ui ) {

        detalles_articulo.descripcion = ui.item.descripcion;
        detalles_articulo.modelo = ui.item.modelo;
        detalles_articulo.existencia = ui.item.existencia;
        detalles_articulo.precio = ui.item.precio;
        detalles_articulo.clave_articulo = ui.item.clave_articulo;
      
        if(ui.item.existencia > 0) {
          $("#alertas").html('');
        } else {
          $("#alertas").html(' <div class="alert alert-danger"> El artículo seleccionado no cuenta con existencia, favor de verificar. </div> ');
        }
        
      }
    });

   $("#boton_agregar").click( function(){


    if( detalles_articulo.existencia > 0) {

      precio_alt = detalles_articulo.precio * ( 1 + (tasa * plazo)/100  );

      precio_alt = precio_alt.toFixed(2);

      $("#tabla_articulos").append("<tr id='renglon_"+ numero_de_renglones +"'> <td>  " 
                    + detalles_articulo.descripcion + "  </td>   <td>  "
                    + detalles_articulo.modelo + " </td>    <td  > <input id='cantidad_"+numero_de_renglones+"' value='1' size='4' onkeyup='colocar_cantidad("+ precio_alt +", "+ numero_de_renglones +")'>  </td>    <td id='precio_alt_"+numero_de_renglones+"'>  "
                    + precio_alt + "  </td>  <td id='importe_"+numero_de_renglones+"'>  "+ precio_alt +" </td>  <td> <button type='button' onClick='borrador( "+ numero_de_renglones+")'> <span style='color:red' class='glyphicon glyphicon-remove'> </span> </button>  </td> <td style='color: white'> "+detalles_articulo.clave_articulo+" </td></tr> ");


      numero_de_renglones = numero_de_renglones + 1;
    }

    sumadora();
   });


   $("#boton_sig_guardar").click(function(){

	
    if( modo_sig_guardar == 0 ){

      

      $("#tabla_articulos").find('tr').each(function (rowIndex, r) {

        var cols=[];
        $(this).find('td').each(function (colIndex, c) {
        	if( colIndex == 2) {


        		cols.push( c);
        	} else {
        		cols.push(c.innerText);
        	}
          
        });

        data.push(cols);


      });

      if( data.length > 1 && $("#dato_rfc").text() != "") {

        $("#boton_sig_guardar").text("Guardar");

        var precio_contado =  total_adeudo / ( 1 + tasa * plazo / 100 );

        var abonos = [3,6,9,12];

        abonos.forEach( function(item,index){

          var total_a_pagar = precio_contado * ( 1 + tasa * item / 100 );

          total_a_pagar = total_a_pagar.toFixed(2);

          $("#td_apagar_" + item).text( "TOTAL A PAGAR $" + total_a_pagar );


          var importe_abono = total_a_pagar / item;

          $("#td_abonos_" + item).text(importe_abono.toFixed(2) ) ;


          var importe_ahorra = total_adeudo - total_a_pagar;

          $("#td_ahorra_" + item).text("SE AHORRA $" + importe_abono.toFixed(2) ) ;


        } );


        $("#tabla_abonos").show();


      } else {
        $("#alertas").html(' <div class="alert alert-danger"> Los datos ingresados no son correctos, favor de verificar </div>  ');
      }

      modo_sig_guardar = 1;


     



    } else {

      var radioVal = $("input[name='optradio']:checked").val();

      if(radioVal == undefined) {
        alert("Debe seleccionar un plazo para realizar el pago de su compra");
      } else {

        var d = new Date();

        var fecha = d.getDate() + "/" + String(parseInt(d.getMonth())+1 ) + "/" + d.getFullYear() ;

        var apagar = $("#td_apagar_"+radioVal).text();
        apagar = apagar.slice(15);

        var rfc = $("#dato_rfc").text()



        $.post("guardar_venta.php",

          {
            total:apagar,
            fecha:fecha,
            clave_cliente:clave_cliente
          },

          function(data, status){
            //alert("Data:" + data);
          }

          );



         var i;
         var num_elems;
        for(i=1; i<data.length; i++){
        	num_elems =  parseFloat( data[i][4])/ parseFloat( data[i][3]) ;
        	id_elems = data[i][6] ;


        	$.post("modificar_inventario.php",

          {
            num_elems:num_elems,
            id_elems:id_elems
          }, 

          function(data, status){
          }


          );



        }
   



        //window.location.reload(true);
        window.location.href = "ventas.php" ;


      }


    } 

  });

  
   



  } );
  </script>

<div class="container">

    <div class="panel panel-default">
    <table class="table table-bordered" >
        <thead>
            <tr > <td style="background-color: #197ebd; color: white"> Registro de Ventas </td> </tr>
        </thead>
        <tr>
            <td> 

                <table class="table borderless">
                    <tr>   <td>    </td>   <td>   </td>    <td>   </td>    <td> Folio venta: <?php echo $_SESSION['numero_de_venta']; ?> </td></tr>

                    <!-- segundo renglon -->

                 <tr> <td> Cliente:</td>  
                    <td>   
                         <div class="ui-widget">   
                        <input id="input_cliente" type="text"> 
                        </div>
                    </td>   

                    <td style="text-align: left; color: grey" > RFC:    </td>    <td style="text-align: left; color: grey" id="dato_rfc"></td>    </tr>


                    <!-- tercer renglon -->

                 <tr> <td> Articulo:</td>  <td> <input id="input_articulo" type="text"> <buttton id="boton_agregar" type="button" > <span class="glyphicon glyphicon-plus-sign"> </span> </button>  </td>   <td>    </td>    <td>   </td>    </tr>

                </table>



             </td>
        </tr>
        <tr>
            <td> 

                <table class="table borderless" id="tabla_articulos">

                    <tbody>
                        <tr>   <td>  Descripción del artículo   </td>   <td>  Modelo </td>    <td> Cantidad  </td>    <td>  Precio  </td>  <td>  Importe </td>  <td> </td> </tr>
                    </tbody>
                </table>


             </td>
        </tr>
        <tr>
            <td align="right">  


                <table >
                    <tr>   <td style="text-align: right; background-color: lightgrey">  Enganche  </td>   <td width="40%" align="center" id="td_enganche">   </td>   </tr>
                    <tr>   <td style="text-align: right; background-color: lightgrey">  Bonificacion Enganche  </td>   <td width="40%" align="center" id="td_bonificacion">  </td>   </tr>
                    <tr>   <td style="text-align: right; background-color: lightgrey">  Total  </td>    <td width="40%" align="center" id="td_total">  </td>    </tr>

                </table>



            </td>
        </tr>
    </table>
</div>

<table class="table table-striped"  style="display: none" id="tabla_abonos"> 
  <thead>

    <tr>
      <td colspan="5"> ABONOS MENSUALES </td>
    </tr>

  </thead>

  <tr>
    <td> 
      3 ABONOS DE
    </td>
    <td id="td_abonos_3">
      $ 123123
    </td>
    <td id="td_apagar_3">
      TOTAL A PAGAR $343434
    </td>
    <td id="td_ahorra_3">
      SE AHORRA $2323
    </td>

    <td>
      <div class="radio">
        <label><input type="radio" name="optradio"  value="3"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td> 
      6 ABONOS DE
    </td>

    <td id="td_abonos_6">
      $ 123123
    </td>
    <td id="td_apagar_6">
      TOTAL A PAGAR $343434
    </td>
    <td id="td_ahorra_6">
      Se AHORRA $2323
    </td>

    <td>
      <div class="radio">
        <label><input type="radio" name="optradio" value="6"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td> 
      9 ABONOS DE
    </td>
    <td id="td_abonos_9">
      $ 123123
    </td>
    <td id="td_apagar_9">
      TOTAL A PAGAR $343434
    </td>
    <td id="td_ahorra_9">
      Se AHORRA $2323
    </td>

    <td>
      <div class="radio">
        <label><input type="radio" name="optradio" value="9"></label>
      </div>
    </td>
  </tr>

  <tr>
    <td> 
      12 ABONOS DE
    </td>
   <td id="td_abonos_12">
      $ 123123
    </td>
    <td id="td_apagar_12">
      TOTAL A PAGAR $343434
    </td>
    <td id="td_ahorra_12">
      Se AHORRA $2323
    </td>

    <td>
      <div class="radio">
        <label><input type="radio" name="optradio" value="12"></label>
      </div>
    </td>
  </tr>



</table>




<div style="text-align: right">
<button type="button" class="btn btn-success" id="boton_sig_guardar">Siguiente </button>
</div>


</div>


</body>
</html>



