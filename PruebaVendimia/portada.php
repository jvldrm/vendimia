

<html lang="en">

<head>
    <title>La vendimia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



 <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <style>


    </style>


    <script>

        $(document).ready(function(){
            var d = new Date();

            $("#laFecha").text("Fecha: " + d.getDate() + "/" + String(parseInt(d.getMonth())+1 ) + "/" + d.getFullYear() );
            

       




        });


    </script>


</head>

<body>

    <div class="container">
        <div class="form-group row">
             <div class="col-lg-4">
            
            </div>
            <div class="col-lg-4">
               
            </div>
            <div class="col-lg-4" >
                    <div align=right style="color: green">
                         <div align="center" id="alertas">
                                <!-- AQUI VA LA INFO -->
                        </div>
                    <h2 > La Vendimia </h2>

                    <div style="position: absolute; left: 98%; top: 60%; z-index:1000 ">


                        <img src="logo.png" width="50vw" height="50vh">

                    </div>


                </div>
            </div>
        </div>
    </div>



<div class="navbar navbar-inverse" >
    <div class="container-fluid">
        
        <ul class="nav navbar-nav" >
            <li class="active" style="background-color: black"> <a href="#" data-toggle="dropdown">Inicio <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                    <li> <a href="ventas.php" > Ventas </a></li>
                    <hr />
                    <li> <a href="clientes.php"> Clientes </a> </li>
                    <li> <a href="articulos.php"> Artículos </a> </li>
                    <li> <a href="configuracion.php"> Configuración </a> </li>
                </ul>


            </li>
            
        </ul>


        <p id="laFecha" class="navbar-text navbar-right" style="color: white">
             FECHA 
        </p>




    </div>
</div>



<?php

$servername = "localhost";
$username = "id10433794_root";
$password = "cocoslocos";

$conn = new mysqli($servername, $username, $password, "id10433794_vendimia_db");


?>



