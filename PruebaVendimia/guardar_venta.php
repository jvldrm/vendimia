<?php
session_start();




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "id10433794_root";
$password = "cocoslocos";

$conn = new mysqli($servername, $username, $password, "id10433794_vendimia_db");


$total = trim( strip_tags( $_POST['total']));
$fecha = trim( strip_tags( $_POST['fecha']));
$clave_cliente = trim( strip_tags( $_POST['clave_cliente']));


$res_cliente = $conn->query("select nombre,apellido_paterno,apellido_materno from clientes where id = $clave_cliente");
$row_cliente = $res_cliente->fetch_assoc();

$nombre = $row_cliente['nombre'] . " " . $row_cliente['apellido_paterno'] . " " . $row_cliente['apellido_materno'];
$conn->query( " insert into ventas (clavecliente,nombre,total,fecha,estatus) values (
			'$clave_cliente',
			'$nombre',
			'$total',
			'$fecha',
			'En progreso'
				) ");






?>