<?php
	
	require_once '../inc/filestore.php';

	$file = new Filestore('data/todo.txt'); 

	$todo_array = $file->read();

	$boolcheck = false;

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

	    $newList = new Filestore($savedFilename);

	    $upload_array = $newList->read();

	    $todo_array = array_merge($todo_array, $upload_array);
	    $file->write($todo_array);

	}

	

	if(isset($_POST['todo'])) {
		try {
			if ((strlen($_POST['todo']) != 0) && (strlen($_POST['todo']) < 10) ) {
				$todo_array[] = $_POST['todo'];
				$file->write($todo_array);		
			} else {
				throw new InvalidInputException('Your Task is flawed!');
			}
		} 

		catch (InvalidInputException $e) {
				echo $e->getMessage();
		}
	}


	if(isset($_GET['remove'])) {
		$id = $_GET['remove'];
		unset($todo_array[$id]);
		$file->write($todo_array);
	}



?>



<!DOCTYTPE html>

<html>
<head>
	<title>Least Fun Todo List Ever</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
</head>

<body>

<div class="container">

	<h1>Least Fun Todo List Ever</h1>

	

    

	<ul>
		<? foreach($todo_array as $key => $value): ?>
			<li><?= htmlspecialchars(strip_tags($value)); ?> | <a href="/todo_list.php?remove=<?= $key ?>">X</a></li>
		<? endforeach; ?>
	</ul>



	<form method="POST" action="/todo_list.php">
		<h2>Add a task:</h3>
		<p>
	        <label for="todo"></label>
	        <input id="todo" name="todo" type="text" placeholder="Add your task">
	    </p>

	    <button type="submit">Add Task</button>
	</form>

	<h2>Upload Todo List</h2>



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