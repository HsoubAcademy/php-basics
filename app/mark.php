<?php
require 'init.php';
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	if(!empty($_GET['task_id'])){
		$task_id = $_GET['task_id'];
		$user_id = $_SESSION['user_id'];
		$done_query = "Update tasks SET done = 1 WHERE id = '".$task_id."' AND user_id = '".$user_id."'";
	  	$connection->query($done_query);
	}
}
header('Location: ../index.php');