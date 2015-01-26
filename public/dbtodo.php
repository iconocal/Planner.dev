<?php
    
    // Get new instance of PDO object
// $dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,DB_park,DB_PASS);

// Tell PDO to throw exceptions on error
// $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "todo_db");
define("DB_USER", "codeup");
define("DB_PASS", "codeup");


// Require the file that connects to the database.
require '../db_connect.php';

// DECLARE FUNCTION getCount(): Gets number of rows in table
function getCount($dbc) {
    $getRowCount = $dbc->query('SELECT  COUNT(*) FROM task_list');
    $rowCount = $getRowCount->fetchColumn();
    return $rowCount;
}

// DECLARE VARIABLES
$tasksPerPage = 10;
$totalTasks = getCount($dbc);
$totalPages = ceil($totalTasks / $tasksPerPage);

// PAGINATION LOGIC
// Check that the page number is set.
if(!isset($_GET['page'])){
    $_GET['page'] = 0;
    $currentPage = $_GET['page'];
}else{
    // Convert the page number to an integer
    $_GET['page'] = (int)$_GET['page'];
    $currentPage = $_GET['page'];
}

if($_GET['page'] < 1){
    // $_GET['page'] = 1;
    $currentPage = 1;
    // Check that the page is below the last page
}else if($_GET['page'] > $totalPages){
    $_GET['page'] = $totalPages;
}


// Determine Offset
$startList = ($currentPage - 1) * $tasksPerPage;


// Prepare query to select all parks. 
$stmt = $dbc->prepare('SELECT * FROM task_list 
    LIMIT :lim
    OFFSET :offset
    ');
        
    $stmt->bindValue(':lim', $tasksPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $startList, PDO::PARAM_INT);
    $stmt->execute();

$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Input into table from form input
if($_POST) {

    // print_r($_POST);
    // var_dump($_POST);
    $stmt = $dbc->prepare('INSERT INTO task_list (task) VALUES (:task)');

        $stmt->bindValue(':task', $_POST['task'], PDO::PARAM_STR);
    
        $stmt->execute();
}


?>

<!DOCTYPE html>

<html>
<head>
    <title>dbTODO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
</head>

<body>

<!-- Main Container Div -->
<div class="container">

    <h1>Calvin's Todo List</h1>

<!--     Todo Task List Table -->
    <table class="table">
        <tr>
            <th>#</th>
            <th>Task</th>
        </tr>

<!-- Loop to Display Task List -->
<?php    
    foreach ($tasks as $key => $task) {
        echo "<tr>";
            foreach ($task as $value) {
                echo "<td>{$value}</td>";
            }      
    }
?>
</table>

<!-- Display page numbers -->
<?php
 foreach(range(1, $totalPages) as $page){
     if($page == 1 || $page == $totalPages || ($page >= $_GET['page'] - 2 && $page <= $_GET['page'] + 2)){
         echo '<a href="?page=' . $page . '"> ' . $page . ' </a>';
     }
}
?> 

<!-- Form Add A Task -->
<form class ="form-inline" method="POST" action="/dbtodo.php">
        <h3>Add A Task:</h3>
        <div class="form-group">
            <label for="task">Task: </label>
            <input id="task" class="form-control" name="task" type="text" placeholder="Add Task">
        </div>
        <button type="submit" class="btn btn-default">Add</button>
    </form>

</div>

<nav>
  <ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="#">Next</a></li>
  </ul>
</nav>  







</body>
</html>




















