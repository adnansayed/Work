<?php

// server info
$server = 'localhost';
$user = 'root';
$pass = NULL;
$db = 'task';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

?>