<?php
/**
 * Created by PhpStorm.
 * User: hermann
 * Date: 9/23/14
 * Time: 15:03 AM
 */
class clientesm // users model todas las funciones realacionadas al mysql
{
    private $connection;
    var $id;
    var $id_user;
    var $f_user;
    var $l_user;
    var $id_cli;
    var $n_cli;

    function __construct()
    {
        require_once('connect.php');
        $this->connection =  new createConnection();    }
    function genera_objeto($data)
    {
        while($result = mysqli_fetch_object($data))
        {
            $query[] = $result;
        }
        return $query;
    }
    function genera_array($data)
    {
        while($result = mysqli_fetch_assoc($data))
        {
            $query[] = $result;
        }
        return $query;
    }
    function lista_clientes(){
        $sql = mysqli_query($this->connection->myconn,"SELECT cpu.id_client as id_clientcpu, cpu.id_user, cli.id as id_client, cli.nombre
FROM clientes_por_usuario cpu right outer JOIN clientes cli ON cpu.id_client = cli.id order by cli.nombre ASC");
        //$sql = mysqli_query($this->connection->myconn,"SELECT * FROM clientes_por_usuario cpu inner join users us on cpu.id_user = us.id");
        return $data = $this::genera_array($sql);
    }
    function clientes_propios($id){
        $sql = mysqli_query($this->connection->myconn,"SELECT id_user FROM `clientes_por_usuario` WHERE id_user = " . $id);
        return $data = $this::genera_array($sql);
    }
    function clientes_demas($id){
        $sql = mysqli_query($this->connection->myconn,"SELECT id_user FROM  `clientes_por_usuario` WHERE id_user <> " . $id);
        return $data = $this::genera_array($sql);
    }
    function actualiza_clientes($data){
        $borra = mysqli_query($this->connection->myconn,"DELETE FROM  `clientes_por_usuario` where id_user = " . $data['id_user']);
        foreach($data['data'] as $value)
        {
            $actualiza = mysqli_query($this->connection->myconn,"INSERT INTO `clientes_por_usuario` (id_user, id_client) values ('".$data['id_user']."', '".$value."') " );
        }
        return 1;
    }
}
//$sql = mysqli_query($this->connection->myconn,"");
?>
