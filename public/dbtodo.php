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
require '../inc/dbfilestore.php';

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

// Input into table from form input
if($_POST) {

    $stmt = $dbc->prepare('INSERT INTO task_list (task, priority) VALUES (:task, :priority)');

    $stmt->bindValue(':task', $_POST['task'], PDO::PARAM_STR);
    $stmt->bindValue(':priority', $_POST['priority'], PDO::PARAM_INT);
    
    $stmt->execute();
}

if(isset($_GET['remove'])) {
    $stmt = $dbc->prepare("DELETE FROM task_list WHERE id= :id");
    $stmt->bindValue(':id', $_GET['remove'], PDO::PARAM_INT);
    $stmt->execute();

    }


// Prepare query to select all parks. 
$stmt = $dbc->prepare('SELECT id, priority, task FROM task_list
    ORDER BY priority ASC 
    LIMIT :lim
    OFFSET :offset
    ');
        
    $stmt->bindValue(':lim', $tasksPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $startList, PDO::PARAM_INT);
    $stmt->execute();


// populate $tasks array with tasks from db
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
            <th>#Priority</th>
            <th>Task</th>
            <th>Remove</th>
        </tr>

<!-- Loop to Display Task List -->
<?php    
    foreach ($tasks as $key => $task) {
        echo "<tr>";
        echo "<td>{$task['priority']}</td>";
        echo "<td>{$task['task']}</td>";
        echo "<td><a href=\"/dbtodo.php?remove={$task['id']}\">X</a></td>";     
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

<!-- Form Add Task -->
    <form class ="form-inline" method="POST" action="/dbtodo.php">
        <h3>Add A Task:</h3>
        <div class="form-group">
            <label for="task">Task: </label>
            <input id="task" class="form-control" name="task" type="text" placeholder="Add Task">
            <label for="priority">Priority: </label>
            <select class="form-control" id="priority" name="priority">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option selected>5</option>
            </select>

        </div>
        
        <button type="submit" class="btn btn-default">Add</button>
    </form>

    <!-- Form Upload Task List -->
    <form method="POST" enctype="multipart/form-data">
        <h3>Upload Todo List:</h3>
        <p>
            <label for="file1"></label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" value="Upload">
        </p>
    </form>

</div>

<!-- Previous/Next Buttons -->
<nav>
  <ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="#">Next</a></li>
  </ul>
</nav>  







</body>
</html>




















