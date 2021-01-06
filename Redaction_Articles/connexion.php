<?php
	define('DB_SERVER', 'devbdd.iutmetz.univ-lorraine.fr');
	define('DB_USERNAME', 'vendetti1u_appli');
	define('DB_PASSWORD', '31914937');
	define('DB_NAME', 'vendetti1u_PrjWeb');

	try {
		$objPdo = new PDO
		('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=vendetti1u_PrjWeb','vendetti1u_appli','31914937' );
		$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if($conn === false) {
	  	die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
		}
	}
	catch( Exception $exception ) {
		die($exception->getMessage());
	}
?>
