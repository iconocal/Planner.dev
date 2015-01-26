<?php

define("DB_HOST", "127.0.0.1");
define("DB_NAME", "todo_db");
define("DB_USER", "codeup");
define("DB_PASS", "codeup");

// Require the file that connects to the database.
require 'db_connect.php';


$query = 'CREATE TABLE tasks (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    task VARCHAR(75) NOT NULL,
    PRIMARY KEY (id)
)';

$dbc->exec($query);







