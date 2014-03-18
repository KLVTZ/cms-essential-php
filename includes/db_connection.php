<?php

	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "klvtz");
	define("DB_NANE", "widget_corp");

	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NANE);

	// Test if connection occured
	if(mysqli_connect_error()) {
		die("Databasew connection failed: " . 
			mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" 
		);
	}
?>
