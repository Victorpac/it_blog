<?php
	require '../includes/db_2.php';
	unset($_SESSION['logged_user']);
	header('location: /static/');
 ?>