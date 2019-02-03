<?php
require_once "init.php";
require_once 'Class.php';
$getInstance = Connect::getInstance();
$conn = $getInstance->getConnection();
$execute = $conn->query("SELECT * FROM tbl_todo_list ORDER BY position ASC");
//var_dump($execute);
$todos = [];
if($execute != false)
{
    while($result = $execute->fetch_assoc())
    {
        $todos[]=new Todo($result);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    
    <title>To-Do</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4"><a href="view_done.php">Completed Task</a></div>
            <div class="col-4"></div>
        </div>
    </div>
<div id="main">

<ul id="accordion" class="todoList">

<?php

    // Looping and outputting the $todos array. The __toString() method
    // is used internally to convert the objects to strings:

    foreach($todos as $item){
        echo $item;
    }

    ?>
    
</ul>
<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
           
                <input type="text" class="form-control" name="text" id="text" placeholder='add todo'>
                
                <button id='addButton' class="form-control-sm submit-btn">Add a ToDo </button>
        
        </div>
        <div class="col-4"></div>
    </div>
</div>


</div>

<!-- This div is used as the base for the confirmation jQuery UI dialog box. Hidden by CSS. -->
<div id="dialog-confirm" title="Delete TODO Item?">Are you sure you want to delete this TODO item?</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src='app.js'>

</script>
</body>
</html>