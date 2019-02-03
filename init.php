<?php
class Connect
{
    private static $instance;
    private  $connection;

    private function __construct()
    {
        define('HOST','localhost');
        define('USER','root');
        define('PASSWORD','');
        define('DB','db_todo');
        

            $this->connection = new mysqli(HOST,USER,PASSWORD,DB);

       if($this->connection->connect_errno)
       {
           echo "Fail To Connect".$this->connection->connect_error;
       }
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance=new Connect();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

}

?>