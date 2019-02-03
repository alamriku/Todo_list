<?php
require_once 'init.php';
class Done {
        
    private $data;
    

    public  function __construct($par)
    {

        if(is_array($par))
        {
            $this->data=$par;
        }
       
    }

    public function  __toString()
    {
        return '<li id="todo-'.$this->data['id'].'" class="todo">


                    <div class="text">'.$this->data['text'].'</div>
                    
                   


                    <div class="actions">
                    
                    <a href="" id="" class="done">Delete</a>
                     </div>

                 </li>';
    }

    public static function delete($data)
    {
        $getInstance = Connect::getInstance();
        $conn = $getInstance->getConnection();
        var_dump($data);
        $id = $data['id'];
        $sql= "DELETE FROM tbl_done WHERE id=$id";
        $exe = $conn->query($sql);
        if($exe != false)
        {
            return true;
        }
        else
        {
            echo 'is not deleted please try again';
        }
    }

}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $done = Done::delete($_POST);
    
}

?>