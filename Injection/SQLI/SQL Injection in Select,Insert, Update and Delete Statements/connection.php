<?php

		
		$dbhost = "localhost";

		$dbuser = "root";

		$dbpass = "Armour@1234";

		$dbname = "sqli_db";

		$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);


		if(mysqli_connect_error()){

			die("Database Connection Failed:" . mysqli_connect_error());
		}


?>