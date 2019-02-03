<?php 
require_once "init.php";
class Todo
{
    
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
                    <a href="" class="edit">Edit</a>
                    <a href="" class="delete">Move To Trash</a>
                     </div>

                 </li>';
    }

    public static function createNew($data)
    {
         $text = $data['text'];
        $getInstance = Connect::getInstance();
        $conn = $getInstance->getConnection();
        $text = self::esc($text);
        if(!$text)
        {
            throw new Exception('wrong input data');
            
        }
       
        $posResult = $conn->query("SELECT MAX(position)+1 FROM tbl_todo_list");
        //var_dump($posResult->fetch_assoc()); this can not be as we are using list below so we have to use fetch_row
       //exit();
        if($posResult->num_rows)
        {

                $posResult=$posResult->fetch_row();
                list($position) = $posResult;
                
        }        
      
        if(empty($position))
        {
            $position = 1;
        }
       // var_dump($conn->query("SELECT * FROM tbl_todo_list WHERE `text`='$text'"));
       // exit();
        if($exe =$conn->query("SELECT * FROM tbl_todo_list WHERE `text`='$text'")->num_rows > 0)
        {
           echo '<div class="text">'.'The task already exist please give alternative name '.'</div>';
            exit();
        }
        $exe = $conn->query("INSERT INTO tbl_todo_list (position,`text`) VALUES ($position,'$text')");
        if($exe == false)
        {
            throw new Exception("Fail to insert data");
        }

        echo ( new Todo( array('id'=>$conn->insert_id,'text'=>$text) ) );// we are showing the created todo id comes from db and text is what is given by user,text is not coming from db in this case createNew todo case
    }

    public static function edit($data)
    {  
        $getInstance = Connect::getInstance();
        $conn = $getInstance->getConnection();
        $id = $_POST['id'];
        $text = $_POST['text'];
        $text = Todo::esc($text);
        if(!$text)
        {
            throw new Exception('wrong update text');
        }
        $exe = $conn->query("UPDATE tbl_todo_list SET `text`='$text' WHERE id=$id");
        //var_dump($exe);
       // exit();
        if($exe != false)
        {
            echo 'The task updated ';
        }
        else
        {
            echo 'Fail to update ';
        }
    }

    public static function esc($str)
    {
        $getInstance = Connect::getInstance();
        $conn = $getInstance->getConnection();
        $str=stripslashes($str);
        return mysqli_real_escape_string($conn,strip_tags($str));
    }
    
    public static function delete($data)
    {
        $getInstance = Connect::getInstance();
        $conn = $getInstance->getConnection();
        $id = $data['id'];
        $sql="INSERT INTO tbl_done (todo_id,`text`) SELECT id,`text` FROM tbl_todo_list WHERE id=$id";
        $exe = $conn->query($sql);

        if($exe != false)
        {
            $sql = "DELETE  FROM tbl_todo_list WHERE id=$id";
            $exe = $conn->query($sql);
        }
    }

    public static function re_arrange($key_value)
    {
        $strVals=[];
        foreach($key_value as $k=>$v)
        {
            
            $strVals[] = ' WHEN '.(int)$v.' THEN '.((int)$k+1);// This is a crital part using join php function which alias of implode in sql qury
        }
       // echo "<pre>";
        //print_r($strVals);
        //print_r(join($strVals));
       // exit();
       if(!$strVals)
       {
           throw new Exception('No Data');
       }
       $position_trick = join($strVals);
       $getInstance = Connect::getInstance();
       $conn = $getInstance->getConnection();
       $sql = "UPDATE tbl_todo_list SET position = CASE id $position_trick ELSE position END";
       $exe= $conn->query($sql);
       var_dump($exe);
       if($exe != false)
       {
           return true;
       }
    }
}

//Todo::createNew("Call the doctor");
?>