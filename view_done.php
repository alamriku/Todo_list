<?php 
require_once "init.php";
require_once 'done.php';
$getInstance = Connect::getInstance();
$conn = $getInstance->getConnection();
$execute = $conn->query("SELECT * FROM tbl_done");
//var_dump($execute);
$todos = [];
if($execute != false)
{
    while($result = $execute->fetch_assoc())
    {
        $todos[]=new Done($result);
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
    <title>Completed Task</title>
</head>
<body>
    <div class="main">

<ul id="accordion" class="todoList">

<?php

    // Looping and outputting the $todos array. The __toString() method
    // is used internally to convert the objects to strings:

    foreach($todos as $item){
        echo $item;
    }

    ?>
    
</ul>
<div id="dialog" title="Delete TODO Item?">Are you sure you want to delete this TODO item?</div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>

    <script >

$('.todo a').click(function(e)
{
currentTODO = $(this).closest('.todo');
currentTODO.data('id',currentTODO.attr('id').replace('todo-',''));
//alert(currentTODO.data('id'));
e.preventDefault();
});

$("#dialog").dialog({
    resizable: false,
    height:200,
    modal: true,
    autoOpen:false,
    buttons: {
        'Delete item': function() {
            var id = currentTODO.data('id');
            //console.log(id);
            $.ajax({
                method:'POST',
                url:"done.php",
                data:{id:id},
                success:function(data,textStatus,xhr){
                    console.log(data);
                currentTODO.fadeOut('fast');
            }
        });

            $(this).dialog('close');
        },
        Cancel: function() {
            $(this).dialog('close');
        }
    }
});
$('.todo a.done').click(function(){
    $("#dialog").dialog('open');
});
    </script>
</body>
</html>