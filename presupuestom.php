<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 10:23 AM
 */

class presupuestom // users model todas las funciones realacionadas al mysql
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

    function lista_presupuesto($number=null , $page=null)
    {
        $sql = mysqli_query($this->connection->myconn,"SELECT prep.id, prep.n_evento, prep.f_presupuesto, prep.f_vencimiento, prep.f_evento, prep.f_aprobacion, prep.f_cobro, cond_pago, cli.nombre AS cli_name, cli.rif, usu.f_name AS user_fname, usu.l_name AS user_lname FROM presupuesto prep INNER JOIN clientes cli ON cli.id = prep.id_clie  INNER JOIN users usu ON usu.id = prep.id_user");
        return $data = $this::genera_objeto($sql);
    }
    function busca_presupuesto($id)
    {
        $sql = mysqli_query($this->connection->myconn,"SELECT prep.id, prep.id_user, prep.id_clie, prep.n_evento, prep.f_presupuesto, prep.f_vencimiento, prep.f_evento, prep.f_aprobacion, prep.f_cobro, cond_pago, cli.nombre AS cli_name, cli.rif, usu.f_name AS user_fname, usu.l_name AS user_lname
FROM presupuesto prep INNER JOIN clientes cli ON cli.id = prep.id_clie INNER JOIN users usu ON usu.id = prep.id_user   where prep.id=".$id." and activo = 1");
        return $data = $this::genera_objeto($sql);
    }
    function actualiza_presupuesto($data, $id)
    {
         $switch = true;
         $keys = array_keys($data);
         $sql = "UPDATE presupuesto set ";
         foreach($keys as $value)
         {
             if($switch) $switch = false; else $sql .= ", ";
             $sql.=  $value."= '".$data[$value]."'" ;
         }
         $sql.= " where id =".$id;
        echo $sql; die();
         if(mysqli_query($this->connection->myconn,$sql))
             echo 1;
          else
             echo 0;
    }
    function borrar_presupuesto($id)
    {

        if(mysqli_query($this->connection->myconn,"UPDATE presupuesto set activo = 0 where id=".(int)$id)) //"DELETE FROM presupuesto where id="
            return 1;
        else
            printf("Errormessage: %s\n", mysqli_error($this->connection->myconn));
    }
    function genera_objeto($data)
    {
        while($result = mysqli_fetch_object($data))
        {
            $query[] = $result;
        }

        return $query;

    }
    function crear_presupuesto($data)
    {
        $switch = true;
        $keys = array_keys($data);
        $sql = "INSERT INTO presupuesto ( ";
        foreach($keys as $value)
        {
             if($switch) $switch = false; else $sql .= ", ";
             $sql.=  $value ;
        }
        $sql.= ") values (" ;
        $switch = true;
        foreach($keys as $value)
        {
        if($switch) $switch = false; else $sql .= ", ";
            $sql.=  "'".$data[$value]."'" ;
        }
        $sql.=  ")" ;
        echo $sql;
        $query = mysqli_query($this->connection->myconn, $sql);
        if($query)
            return 1;
        else
            return 0;

    }

}

?>
