<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	define("HOST","localhost");
	define("USER","root");
	define("PASS","password");
	define("BASE","incidente");

	$conn = new mysqli(HOST,USER,PASS,BASE);