<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 12:40 PM
 */

class presupuestoc // users controller
{
    var $presupuestom;

    function __construct()
    {
        require_once('presupuestom.php');
        $this->presupuestom = new presupuestom();

    }

    function crear_presupuesto($data , $file=null)
    {

        echo $this->presupuestom->crear_presupuesto($data);

    }
    function busca_presupuesto($id)
    {
        $user= $this->presupuestom->busca_presupuesto($id);
        return $user[0];

    }
    function actualiza_presupuesto($data , $file=null, $id , $switch = false)
    {
        echo $this->presupuestom->actualiza_presupuesto($data, $id);
    }
    function delete_presupuesto($id)
    {

            if($_SESSION['session']->delete=='1')
                $query = $this->presupuestom->borrar_presupuesto($id);
            else
                $query = 0;
            return $query;



    }

}


