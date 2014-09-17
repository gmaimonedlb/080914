<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 10:23 AM
 */

class usersm // users model todas las funciones realacionadas al mysql
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

    function lista_usuarios($number=null , $page=null)
    {
        $sql = mysqli_query($this->connection->myconn,"SELECT  us.id as user_id, us.f_name, us.l_name, us.email, us.id_tipo, us.id_carg, us.image, us.password, ca.nombre as cargo, ca.descripcion, tu.name as tipo_usu, tu.create, tu.read, tu.update, tu.delete, tu.create_user, tu.authorize   FROM tipos_user tu INNER JOIN users us ON us.id_tipo = tu.id INNER JOIN cargos ca ON ca.id = us.id_carg ");
        return $data = $this::genera_objeto($sql);
    }
    function busca_usuario($id)
    {
        $sql = mysqli_query($this->connection->myconn,"SELECT  us.id as user_id, us.f_name, us.l_name, us.email, us.id_tipo, us.id_carg, us.image,  us.password, ca.nombre as cargo, ca.descripcion, tu.name as tipo_usu, tu.create, tu.read, tu.update, tu.delete, tu.create_user, tu.authorize   FROM tipos_user tu INNER JOIN users us ON us.id_tipo = tu.id INNER JOIN cargos ca ON ca.id = us.id_carg  where us.id=".$id);
        return $data = $this::genera_objeto($sql);
    }
    function actualiza_usuario2($data, $id)
    {
         $switch = true;
         $keys = array_keys($data);
         $sql = "UPDATE users set ";
         foreach($keys as $value)
         {
             if($switch) $switch = false; else $sql .= ", ";
             $sql.=  $value."= '".$data[$value]."'" ;
         }
         $sql.= " where id =".$id;
         if(mysqli_query($this->connection->myconn,$sql))
             echo 1;
          else
             echo 0;
    }
    function borrar_ususario($id)
    {

        if(mysqli_query($this->connection->myconn,"DELETE FROM users where id=".(int)$id))
            return 1;
        else
            printf("Errormessage: %s\n", mysqli_error($this->connection->myconn));
    }
    function login($user, $password)
    {
        $user = trim($user);
        $password = trim($password);

        $sql = mysqli_query($this->connection->myconn,"SELECT  us.id as user_id, us.f_name, us.l_name, us.email, us.image, ca.nombre as cargo, ca.descripcion, tu.name as tipo_usu, tu.create, tu.read, tu.update, tu.delete, tu.create_user, tu.authorize   FROM tipos_user tu INNER JOIN users us ON us.id_tipo = tu.id INNER JOIN cargos ca ON ca.id = us.id_carg where email = '$user' AND password = '$password'");
        $user = $this::genera_objeto($sql);
        return $user[0];

    }
    function genera_objeto($data)
    {
        while($result = mysqli_fetch_object($data))
        {
            $query[] = $result;
        }

        return $query;

    }
    function crear_usuario($data)
    {
        $verifica_correo = $this::verifica_correo($data['email']);
        if($verifica_correo->num_rows<1)
        {
            $switch = true;
            $keys = array_keys($data);
            $sql = "INSERT INTO users ( ";
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
            $query = mysqli_query($this->connection->myconn, $sql);
            if($query)
                return 1;
            else
                return 0;
        }else
        {
            return 2;
        }
    }
    function verifica_correo($data)
    {
        $email = trim($data);
        $sql = "SELECT * FROM `users` where email  = '$email'";
        $query = mysqli_query($this->connection->myconn, $sql);
        return $query;
    }
}

?>
