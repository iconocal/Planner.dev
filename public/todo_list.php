<?php

		$todo_array = openfile('data/todo.txt');

	// Verify there were uploaded files and no errors
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
	    // Set the destination directory for uploads
	    $uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

	    // Grab the filename from the uploaded file by using basename
	    $filename = basename($_FILES['file1']['name']);


	    // Create the saved filename using the file's original name and our upload directory
	    $savedFilename = $uploadDir . $filename;

	    // Move the file from the temp location to our uploads directory
	    move_uploaded_file($_FILES['file1']['tmp_name'], $savedFilename);

	    $upload_array = openfile($savedFilename);


	    $todo_array = array_merge($todo_array, $upload_array);
	    writeFile('data/todo.txt', $todo_array);

	}



	function writeFile($filename, $arrayList) {
		$handle = fopen($filename, 'w');
		foreach ($arrayList as $listItem) {
			fwrite($handle, $listItem . PHP_EOL);
			}
		fclose($handle);
	}

	function openfile($filename) {
		$handle = fopen($filename, 'r');
		$contents = trim(fread($handle, filesize($filename)));
		$todo_array = explode("\n", $contents);
		fclose($handle);
		return $todo_array;
	}





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
		<? foreach($todo_array as $key => $value): ?>
			<li><?= $value ?> | <a href="/todo_list.php?remove=<?= $key ?>">X</a></li>
		<? endforeach; ?>
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

	<h2>Upload TO DO List</h2>



	<form method="POST" enctype="multipart/form-data">
        <p>
            <label for="file1">File to upload: </label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" value="Upload">
        </p>
    </form>

</div>
	


</body>
</html>