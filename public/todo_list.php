<?php

	$todo_array = [];

	function writeFile($filename, $arrayList) {
	// $filename = $path;
	$handle = fopen($filename, 'w');
	foreach ($arrayList as $listItem) {
		fwrite($handle, $listItem . PHP_EOL);
		}
	fclose($handle);
}


	// //FUTURE OPTION
	function openfile($filename) {
		$handle = fopen($filename, 'r');
		$contents = trim(fread($handle, filesize($filename)));
		$todo_array = explode("\n", $contents);
		fclose($handle);
		return $todo_array;
	}

	$todo_array = openfile('data/todo.txt');

	if(isset($_POST['todo'])) {
		$todo_array[] = $_POST['todo'];
		writeFile('data/todo.txt', $todo_array);
		
	}


	if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	unset($todo_array[$id]);
	writeFile('data/todo.txt', $todo_array);
	}
?>



<!DOCTYTPE html>

<html>
<head>
	<title>Least Fun TO DO List Ever</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
</head>

<body>

<div class="container">

	<h1>Least Fun TO DO List Ever</h1>

	<ul>
		<?php
			foreach($todo_array as $key => $value) {
				echo "<li>{$value} | <a href=\"/todo_list.php?remove={$key}\">X</a> </li>";
			}
		?>
	</ul>



	<form method="POST" action="/todo_list.php">
		<h3>Add a task to the TO DO List:</h3>
		<p>
	        <label for="todo">New Item: </label>
	        <input id="todo" name="todo" type="text" placeholder="Add your task">
	    </p>
	   
		<br>

	    <button type="submit">Add Task</button>
	</form>

</div>
	


</body>
</html>