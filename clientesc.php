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

            $option[] = '<input type=checkbox  name=' . $value['id_client'] . '  ' . $selected ." ".$disable . '> ' . $value['nombre'] . '<br /> ';
        }
        return $option;






 /*
            echo  $selected ." ".$disable;
         $option[] = '<label><input type=checkbox class="flat-red" name=' . $value['id_client'] . '  ' . $selected ." ".$disable . '> ' . $value['n_client'] . '</label><br /> ';
        }
        return $option;*/




    }
/*    function genera_checkboxes_clientes($id_user)
    {
       // va a recibir id de user
        $selected = "";
        $lista = $this->clientesm->lista_clientes();
        //var_dump($lista);
        foreach( $lista as $value)
        {
            if($id_user == $value->id)
                $selected = " selected";
            else 
                $selected="";

            $option[] = '<label><input type=checkbox class="flat-red" name=' . $value->id . '  ' . $selected . '> ' . $value->nombre . '</label><br /> ';
        }
        return $option;
    }//genera_chkbx clientes propios
    
    function lista_clientes(){
        $result = this->clientesm->lista_clientes();
        
        var_dump($result);
    }
    

    function genera_checkboxes_noclientes($id_user){
        foreach( $lista as $value)
        {
            if($id_user == $value->id)
                $selected = " selected";
            else
                $selected="";

            $option[] = '<label><input type=checkbox class="flat-red" name=' . $value->id . '  ' . $selected . '> ' . $value->nombre . '</label><br /> ';
        } // foreach
    } // gen_chk_no*/
    
} // clientesc