<?php

	
	$addressBook = [
	    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
	    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
	    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
	];
	
	// Write $addressBook array to address_book.csv
	// $handle = fopen('address_book.csv', 'w');
	// foreach ($addressBook as $row) {
 //    	fputcsv($handle, $row);
	// }
	// fclose($handle);


	// Check for $_POST request

	if (!empty($_POST)) {

		foreach ($_POST as $key => $value) {
			
			$error = false;

			if (empty($value)) {
				$error = true;
			} 
		}		

			if ($error) {
					$message = "Please fill out all fields.";
				} else {
					$addressBook[] = $_POST;
					}	
			
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

	foreach ($addressBook as $address) {
		echo "<tr>";
			foreach ($address as $value) {
				echo "<td>{$value}</td>";
			}
		}

	?>
	</table>


<br>
<br>
<br>


	<? if (isset($message)): ?>
		<p><?= $message ?></p>
	<? endif ?>

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

	<!-- <h2>Upload TO DO List</h2>



	<form method="POST" enctype="multipart/form-data">
        <p>
            <label for="file1">File to upload: </label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" value="Upload">
        </p>
    </form> -->

</div> <!-- Container -->
	


</body>
</html>