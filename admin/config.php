<?php

	$con = new mysqli("localhost","root","","realestatephp");
	if (!$con)
	{
		echo "Failed to connect to MySQL: " . $con->error;
	}
	
?>
