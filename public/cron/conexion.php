<?php

$database="woloskyg_wolosky";
$user="woloskyg_vaksfk";
$password="jaqart_56923";
$conexion= mysqli_connect("74.63.215.106",$user, $password) or die(mysql_error());
	mysqli_select_db($conexion,$database) or die("Cannot select DataBase");

		

?>