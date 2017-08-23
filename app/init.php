<?php

session_start();
$_SESSION['user_id'] = 1;
if(!isset($_SESSION['user_id'])){
	die('لم تقم بتسجيل الدخول');
}

$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "todo";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

