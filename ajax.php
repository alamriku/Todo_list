<?php
require_once "Class.php";

try
{
    switch($_SERVER['REQUEST_METHOD'])
    {
            case 'POST':
            if(isset($_POST['id']))
            {
                Todo::edit($_POST);
            }
            elseif(isset($_POST['positions']))
            {
                Todo::re_arrange($_POST['positions']);
            }
            else
            {
                Todo::createNew($_POST);
            }
            
            break;

           case 'GET':
           Todo::delete($_GET);
           break; 
       
    }
}
catch(Exception $e)
{
$e->getMessage();
}

?>