<?php

// Get new instance of PDO object
// $dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,DB_park,DB_PASS);

// Tell PDO to throw exceptions on error
// $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "national_parks_db");
define("DB_USER", "parks_user");
define("DB_PASS", "codeup");

require 'db_connect.php';

$parks = [
    ['name' => 'Crater Lake',   'location' => 'Oregon', 'date_established' => '1902-05-22', 'area_in_acres' => '183224.05', 'description' => 'Big Hole.'],
    ['name' => 'Everglades',   'location' => 'Florida', 'date_established' => '1934-05-30', 'area_in_acres' => '1508537.90', 'description' => 'Big Swamp.'],
    ['name' => 'Hot Springs',   'location' => 'Arkansas', 'date_established' => '1921-03-04', 'area_in_acres' => '5459.75', 'description' => 'Big Mosquitos.'],
    ['name' => 'Mount Rainier',   'location' => 'Washington', 'date_established' => '1899-03-02', 'area_in_acres' => '235625.00', 'description' => 'Big Deal.'],
    ['name' => 'Olympic',   'location' => 'Washington', 'date_established' => '1938-06-29', 'area_in_acres' => '922650.86', 'description' => 'Big O.'],
    ['name' => 'Rocky Mountain',   'location' => 'Colorado', 'date_established' => '1915-01-26', 'area_in_acres' => '265828.41', 'description' => 'Big Hole.'],
    ['name' => 'Shenandoah',   'location' => 'Virginia', 'date_established' => '1926-05-22', 'area_in_acres' => '199045.23', 'description' => 'Big Road Closures.'],
    ['name' => 'Yellowstone',   'location' => 'Montana', 'date_established' => '1872-03-01', 'area_in_acres' => '2219790.71', 'description' => 'Big Sky Country.'],
    ['name' => 'Big Bend',   'location' => 'Texas', 'date_established' => '1944-06-12', 'area_in_acres' => '801163.21', 'description' => 'Big Waste of Time.'],
    ['name' => 'Glacier Bay',   'location' => 'Alaska', 'date_established' => '1980-12-02', 'area_in_acres' => '3224840.31', 'description' => 'Big Hassle.']
];


$stmt = $dbc->prepare('INSERT INTO national_parks (name, location, date_established, area_in_acres, description) VALUES (:name, :location, :established, :area, :description)');

foreach ($parks as $park) {
    $stmt->bindValue(':name', $park['name'], PDO::PARAM_STR);
    $stmt->bindValue(':location', $park['location'], PDO::PARAM_STR);
    $stmt->bindValue(':established', $park['date_established'], PDO::PARAM_STR);
    $stmt->bindValue(':area', $park['area_in_acres'], PDO::PARAM_STR);
    $stmt->bindValue(':description', $park['description'], PDO::PARAM_STR);
    

    $stmt->execute();
}

// foreach ($parks as $park) {
//     $query = "INSERT INTO national_parks (name, location, date_established, area_in_acres) VALUES ('{$park['name']}', '{$park['location']}', '{$park['date_established']}', '{$park['area_in_acres']}')";

//     $dbc->exec($query);

//     echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
// }


// $countStmt = $dbc->query('SELECT count(*) FROM national_parks');
// $result = $countStmt-fetchColumn();
// $result = $countStmt-fetch(PDO::FETCH_ASSOC);

// echo $result[0]['count(*)'] . PHP_EOL;





