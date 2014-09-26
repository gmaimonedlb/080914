<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 10:23 AM
 */

class departamentosm // users model todas las funciones realacionadas al mysql
{
    var $connection;
    var $id;
    Var $f_name;
    var $l_name;
    var $email;
    var $id_carg;
    var $password;
    var $id_tipo;
    var $image;


    function __construct()
    {
        require_once('connect.php');
        $this->connection =  new createConnection();
    }

    function lista_departamentos($number=null , $page=null)
    {
        $sql = mysqli_query($this->connection->myconn,"SELECT  id, nombre FROM departamentos order by nombre ASC ");
        return $data = $this::genera_objeto($sql);
    }
    function genera_objeto($data)
    {
        while($result = mysqli_fetch_object($data))
        {
            $query[] = $result;
        }

        return $query;

    }

}

?>
