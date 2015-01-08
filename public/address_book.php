<?php

$filename = 'address_book.csv';

class AddressDataStore
 {
    public $csvFile = '';

    function readAddressBook()
    {
	    $handle = fopen($this->csvFile, 'r');

		$addressBook = [];

		while (!feof($handle)) {
			$row = fgetcsv($handle);

			if (!empty($row)) {
				$addressBook[] = $row;
			}
		}
	
		fclose($handle);
		return $addressBook;
    }

    function writeAddressBook($array)
    {
    	$handle = fopen($this->csvFile, 'w');

		foreach ($array as $row) {
			fputcsv($handle, $row);
		}

		fclose($handle);
    }

 }

 	// Create instance = $addressList
 	// pass $filename to $addressList->csvFile

 	$addressList = new AddressDataStore();
 	$addressList->csvFile = $filename;
 	$addressBook = $addressList->readAddressBook();

	

	if($_POST) {
		$addressBook[] = $_POST;
		// save_file($filename, $addressBook);
		$addressList->writeAddressBook($addressBook);
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

		echo "<td><a href=\"address_book.php?remove= $key \">X</td>";		
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

	

</div> <!-- Container -->
	

// function read_file($filename) {

// 	$handle = fopen($filename, 'r');

// 	$addressBook = [];

// 	while (!feof($handle)) {
// 		$row = fgetcsv($handle);

// 		if (!empty($row)) {
// 			$addressBook[] = $row;
// 		}
// 	}
	
// 	fclose($handle);
// 	return $addressBook;
// }

// function save_file($filename, $array) {
// 	$handle = fopen($filename, 'w');
// 	foreach ($array as $row) {
// 		fputcsv($handle, $row);
// 	}

// 	fclose($handle);
// }


// function check_post($_POST) {
// 	if (!empty($_POST)) {
// 		foreach ($_POST as $key => $value) {
		
// 			$error = false;

// 			if (empty($value)) {
// 				return $error = true;
// 			}
// 		}
// 	}
// }
</body>
</html>

