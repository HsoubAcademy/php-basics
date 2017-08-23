<?php
require 'init.php';
function validate_date($date_string){
	if ($time = strtotime($date_string))
		return $time;
	else 
		return false;
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	//validate that the task & date are exist and not empty
	if((!empty($_POST['name'])) and (!empty($_POST['due_date']))){
		$due_date = $_POST['due_date'];
		//Validate if the entered date is a valid date
		$due_date = validate_date($due_date);
		if ($due_date == false){
			$errors['not_valid_date'] = "يجب أن تدخل التاريخ بصورة صحيحة، مثل: 1-1-2014";
			$_SESSION['errors'] = $errors;
		}
		else{
			//trim to remove white space
			$name = trim($_POST['name']);
			$user_id = $_SESSION['user_id'];
			$due_date = date('Y-m-d H:i:s', $due_date);  
			$added_query = "INSERT INTO tasks (name, user_id, due_date) VALUES ('".$name."', '".$user_id."', '".$due_date."')";
			$connection->query($added_query);
		}
	}
	else{
		if(empty($_POST['name'])){
			$errors['required_name'] = "يجب أن تقوم بكتابة وصف للمهمة";
		}
		if(empty($_POST['due_date'])){
			$errors['required_Date'] = "يجب أن تقوم تعيين آخر مهلة لإنجاز المهمة";	
		}
		$_SESSION['errors'] = $errors;
	}
}
header('Location: ../index.php');