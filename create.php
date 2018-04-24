<?php 
	session_start();
	require_once 'csrf.php'; 
	$csrf = new CSRF();
	if($csrf->check()){
		echo "CSRF IS FINE<br>";
		echo "NAME: ".$csrf->filter($_POST["name"]);
		echo "<br>VALUE: ".$csrf->filter($_POST["value"]);
	}else{
		echo "CSRF WRONG";
	}
?>
