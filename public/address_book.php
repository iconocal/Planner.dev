<?php

require_once '../inc/address_data_store.php';

	$addressList = new AddressDataStore('Address_Book.csv');

 	$addressBook = $addressList->read(); 


	// // Verify there were uploaded files and no errors
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
		// Set the destination directory for uploads
	    $uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

	    // Grab the filename from the uploaded file by using basename
	    $filename = basename($_FILES['file1']['name']);


	    // Create the saved filename using the file's original name and our upload directory
	    $savedFilename = $uploadDir . $filename;
	    // var_dump($savedFilename);

	    move_uploaded_file($_FILES['file1']['tmp_name'], $savedFilename);

	 	$newBook = new AddressDataStore($savedFilename);
	    $uploadBook = $newBook->read();
	    $addressBook = array_merge($addressBook, $uploadBook);
	    $addressList->write($addressBook);
	    
	}

 	if($_POST) {
		foreach ($_POST as $value) {
			if (strlen($value) > 125) {
				throw new Exception('Entry too long');
			}
		}
		$addressBook[] = $_POST;
		$addressList->write($addressBook);
	}


	if(isset($_GET['remove'])) {
		$remove = $_GET['remove'];
		unset($addressBook[$remove]);
		$addressBook = array_values($addressBook);
		$addressList->write($addressBook);
	}

	

?>



<!DOCTYTPE html>

<html>
<head>
	<title>Address Book</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
</head>

<body>

<div class="container">

	<h1>Address Book</h1>

<!-- ADDRESS BOOK TABLE -->
	<table class="table">
		<tr>
			<th>Location</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip Code</th>
		</tr>

<!-- 		Start working with PHP to echo out the data from $addressBook -->
	<?php


	foreach ($addressBook as $key => $address) {
		echo "<tr>";
			foreach ($address as $value) {
				echo "<td>{$value}</td>";
			}

		echo "<td><a href=\"address_book.php?remove=$key\">X</td>";		
	}

	?>
	</table>

	<br>

	<h2>Upload Contact List</h2>

	<form method="POST" enctype="multipart/form-data" action="address_book.php">
        <p>
            <label for="file1">File to upload: </label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" value="Upload">
        </p>
    </form>

<br>

	<form method="POST" action="/address_book.php">
		<h3>Add an entry:</h3>
		<div class="form-group">
	        <label for="name">Name: </label>
	        <input id="name" class="form-control" name="name" type="text" placeholder="Add Name">
	    </div>
	    <div class="form-group">
	        <label for="street">Street Address: </label>
	        <input id="street" class="form-control" name="street" type="text" placeholder="Add Street">
	    </div>
	    <div class="form-group">
	        <label for="city">City: </label>
	        <input id="city" class="form-control" name="city" type="text" placeholder="Add City">
	    </div>
	    <div class="form-group">
	        <label for="state">State: </label>
	        <input id="state" class="form-control" name="state" type="text" placeholder="Add State">
	    </div>
	    <div class="form-group">
	        <label for="zipcode">Zipcode: </label>
	        <input id="zipcode" class="form-control" name="zipcode" type="text" placeholder="Add Zipcode">
	    </div>
	   
	    <button type="submit" class="btn btn-default">Submit</button>
	</form>

	

</div> <!-- Container -->
	


</body>
</html>








