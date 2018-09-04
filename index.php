<?php
	if($_SERVER['REQUEST_METHOD'] === 'GET'){
		require 'app/init.php';
		$user_id = $_SESSION['user_id'];
		$getTasks_query = "SELECT id, description, done, due_date FROM tasks WHERE user_id = $user_id";
		$result = $connection->query($getTasks_query);
		$tasks = $result->num_rows > 0 ? $result : [];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>المساعد الشخصي لإدارة المهام</title>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div class="container">
			<h1 class="header">مهماتي</h1>
			<?php if(!empty($tasks)):?>
				<ul class="tasks">
					<?php foreach ($tasks as $task): ?>
						<li>
							<span class="task <?= $task['done'] ? 'done' : ''?>"><?= $task['description']?></span>
							<?php if(!$task['done']):?>
								<a href="app/mark.php?task_id=<?= $task['id']?>" class="task-buttons">تمَ الإنجاز</a>
							<?php else:?>
								<a href="app/delete.php?task_id=<?= $task['id']?>" class="task-buttons">حذف المهمة</a>
							<?php endif;?>
							<?php $task['due_date'] = strtotime($task['due_date']);?>
							<p class="date">آخر تاريخ لإنجاز المهمة: <?= date('Y-m-d', $task['due_date'])?></span>
						</li>
					<?php endforeach;?>
				</ul>
			<?php else: ?>
				<p>لم تقم بإضافة أي مهمة للقيام بها!</p>
			<?php endif;?>
			<?php if(isset($_SESSION['errors'])):?>
				<?php foreach ($_SESSION['errors'] as $error): ?>
					<?= "<p class=\"error\">$error</p>";?>
				<?php endforeach;?>
				<?php $_SESSION['errors'] = [];?>
			<?php endif;?>
			<form class="add-task" action="app/add.php" method="post">
				<input type="text" name="task_name" placeholder="أدخل وصف لمهمة جديدة هنا" class="input">
				<input type="text" name="due_date" placeholder="أدخل آخر تاريخ لإنجاز المهمة، مثال: 1-1-2014" class="input">
				<input type="submit" value="أضف" class="submit">
			</form> 
		</div>
	</body>
</html>