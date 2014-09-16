<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 10:23 AM
 */
require_once('connect.php');

class cargosm extends createConnection // users model todas las funciones realacionadas al mysql
{
    private $connection;
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
        $this->connection =  new createConnection();
    }

    function lista_cargos()
    {
        $sql = mysqli_query($this->connection->myconn,"SELECT id, nombre, descripcion FROM cargos");
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
