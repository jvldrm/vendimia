<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "id10433794_root";
$password = "cocoslocos";

$conn = new mysqli($servername, $username, $password, "id10433794_vendimia_db");


$term = trim( strip_tags( $_GET['term']));

$query = "SELECT distinct * FROM clientes WHERE nombre LIKE '".$term."%' or apellido_materno LIKE '".$term."%' or apellido_paterno LIKE '".$term."%'";


$result = $conn->query($query);
$count = 0;
while( $ren = $result->fetch_assoc() ){

	$id_foliada = 0;

	if( $ren['id']  < 10) {
		$id_foliada = "00" . $ren['id'];
	}elseif ($ren['id'] < 100) {
		$id_foliada = "0" . $ren['id'];
	}


	$row['clave_cliente'] = $ren['id'];

	$row['value'] = $id_foliada . " - " . $ren['nombre'] . " " . $ren['apellido_paterno'] . " " . $ren['apellido_materno'];

	$row['rfc'] = $ren['rfc'];

	$count = $count + 1;

	$row['id'] = $count;
	$row_set[] = $row;

}



echo json_encode($row_set);

?>