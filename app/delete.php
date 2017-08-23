<?php
require 'init.php';
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	if(isset($_GET['task_id'])){
		$task_id = $_GET['task_id'];
		$user_id = $_SESSION['user_id'];
		$delete_query = "delete FROM tasks WHERE id = '".$task_id."' AND user_id = '".$user_id."'";
	  	$connection->query($delete_query);
	}
}
header('Location: ../index.php');