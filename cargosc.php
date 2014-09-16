<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 12:40 PM
 */
require_once('cargosm.php');


class cargosc extends cargosm// users controller
{
    private $cargosc;

    function __construct()
    {
        $this->cargosm = new cargosm();

    }
    function genera_select_cargos($id = null)
    {
        $selected = "";
        $lista = $this->cargosm->lista_cargos();
        foreach( $lista as $value)
        {
            if(!is_null($id))
                if($id == $value->id)
                    $selected = " selected";
                else
                    $selected="";

                $option[]= '<option value="'.$value->id.'"  '.$selected.'>'.$value->nombre.'</option> ';
        }
        return $option;



    }
}


