<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "id10433794_root";
$password = "cocoslocos";

$conn = new mysqli($servername, $username, $password, "id10433794_vendimia_db");


$term = trim( strip_tags( $_GET['term']));

$query = "SELECT distinct * FROM articulos WHERE descripcion LIKE '%".$term."%' or modelo LIKE '%".$term."%'";


$result = $conn->query($query);
$count = 0;
while( $ren = $result->fetch_assoc() ){
	$row['value'] = $ren['descripcion'] . ", " . $ren['modelo'];


	$row['descripcion'] = $ren['descripcion'];
	$row['modelo'] = $ren['modelo'];
	$row['existencia'] = $ren['existencia'];
	$row['precio'] = $ren['precio'];
	$row['clave_articulo'] = $ren['id'];


	$count = $count + 1;

	$row['id'] = $count;
	$row_set[] = $row;

}



echo json_encode($row_set);

?>