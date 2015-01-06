<?php

$filename = 'address_book.csv';

function read_file($filename) {
	$handle = fopen($filename, 'r');

	$addressBook = [];

	while(!feof($handle)) {
	    $row = fgetcsv($handle);

	    if (!empty($row)) {
	        $addressBook[] = $row;
	    }
	}

	fclose($handle);
	return $addressBook;
}

function save_file($filename, $array) {
	$handle = fopen($filename, 'w');

	foreach ($array as $row) {
    fputcsv($handle, $row);
	}

	fclose($handle);
}

$addressBook = read_file($filename);

if($_POST) {
	$addressBook[] = $_POST;
	save_file($filename, $addressBook);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <title>Naughty Or Nice Spitter Outer</title>
 
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 
  <body>
 
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Naughty-Nice-erator</a>
        </div>
        
      </div>
    </nav>
 
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Feliz Navidad</h1>
      </div>
    </div>
 
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
          <h2>Running the List... Checking it twice...</h2>
          <table class="table table-striped">
						<? foreach($addressBook as $address): ?>
							<tr>
								<? foreach($address as $info): ?>
									<td><?= $info ?></td>
								<? endforeach; ?>
									<td class="delete">X</td>
							</tr>
						<? endforeach; ?>
					</table>
 
					<form action="/address.php" method="POST">
						<input type="text" name="name" placeholder="Name">
						<input type="text" name="address" placeholder="Address">
						<input type="text" name="city" placeholder="City">
						<input type="text" name="state" placeholder="State">
						<input type="text" name="state" placeholder="Zip">
						<input type="submit" value="Save">
					</form>
 
        </div>
      </div>
 
      <hr>
 
      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->
 
 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>