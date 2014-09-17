<?php
/**
 * Created by PhpStorm.
 * User: gustavo maimone
 * Date: 9/10/14
 * Time: 5:18 PM
 */
error_reporting(E_ALL ^ E_NOTICE);
class createConnection //create a class for make connection
{

    private  $host;
    private $username;    // specify the sever details for mysql
    private $password;
    private $database;
    var $myconn;

    function __construct()
    {
        session_start();
        require('config.php');
        $this->host= $config['host_db'];
        $this->username = $config['user_db'];
        $this->password=$config['password_db'];
        $this->database=$config['database_db'];
        $this::connectToDatabase();
    }

    function connectToDatabase() // create a function for connect database
    {

        $conn= mysqli_connect($this->host,$this->username,$this->password,$this->database);

        if(!$conn)// testing the connection
        {
            die ("Cannot connect to the database");
        }
        else
        {
            $this->myconn = $conn;
           // echo "Connection established";
        }
        return $this->myconn;
    }
    function closeConnection() // close the connection
    {
        mysqli_close($this->myconn);
    }

}

?>