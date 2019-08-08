<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "id10433794_root";
$password = "cocoslocos";

$conn = new mysqli($servername, $username, $password, "id10433794_vendimia_db");

$id = trim( strip_tags( $_POST['id_elems']));
$num = trim( strip_tags( $_POST['num_elems']));

$res_v = $conn->query("select existencia from articulos where id=$id");

$row_v = $res_v->fetch_assoc();

$nuevo_existencia = $row_v['existencia'] - $num;


$conn->query("update articulos set existencia = '$nuevo_existencia' where id=$id");

echo "OK IM DONE $id and $num";