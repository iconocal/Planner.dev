<?php



// $filename = 'list.txt';
// $handle = fopen($filename, 'r');
// $contents = trim(fread($handle, filesize($filename)));
// $contentsArray = explode("\n", $contents);

// foreach ($contentsArray as $key => $value) {
// 	# code...
// }

// The CSV Way 

$addressBook = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
];

$handle = fopen('address_book.csv', 'w');

foreach ($addressBook as $row) {
    fputcsv($handle, $row);
}

fclose($handle);






?>