<?php
/**
 * Created by PhpStorm.
 * User: hermann
 * Date: 9/23/14
 * Time: 16:22 PM
 */
require_once('clientesm.php');


class clientesc // users controller
{
    private $clientesc;

    function __construct()
    {
        $this->clientesm = new clientesm();
    }
    function lista_clientes($id)
    {

        $clientes_user1 = $this->clientesm->clientes_propios($id);
        foreach($clientes_user1 as $value)
        {
            $clientes_user[]=$value['id_user'];
        }
        $clientes_otros1 = $this->clientesm->clientes_demas($id);
        foreach($clientes_otros1 as $value)
        {
            $clientes_otros[]=$value['id_user'];
        }
        $lista_clientes = $this->clientesm->lista_clientes();

       // $result = array('lista_clientes'=>$lista_clientes,'clientes_otros'=>$clientes_otros,'clientes_user'=>$clientes_user);

        foreach( $lista_clientes as $value)
        {
            if(in_array( $value['id_user'], $clientes_user))
            {
                $selected = " checked ";
            }else{
                $selected="";
            }
            if(in_array($value['id_user'], $clientes_otros))
            {

                $disable = "  disabled";

            }else{
                $disable="";

            }

            $option[] = '<input type=checkbox name="id[]" id="' . $value['id_client'] . '"  value=' . $value['id_client'] . '  ' . $selected ." ".$disable . '> ' . $value['nombre'] . '<br /> ';
        }

        return $option;
    }
    function guardar($data)
    {
        $this->clientesm->actualiza_clientes($data);

    }












    
} // clientesc