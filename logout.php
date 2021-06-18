<?php
    
    include 'config.php';

	if (isset($_COOKIE["token"])){
		setcookie("token", '', time() - 1800, "/");
	}

	header("location:$link");

?>