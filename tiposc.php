<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 12:40 PM
 */
require_once('tiposm.php');


class tiposc extends tiposm// users controller
{
    private $tiposc;

    function __construct()
    {
        $this->tiposm = new tiposm();

    }
    function genera_select_tipos($id=null)
    {
        $selected = "";
        $lista = $this->tiposm->lista_tipos();
        foreach( $lista as $value)
        {
            if(!is_null($id))
                if($id == $value->id)
                    $selected = " selected";
                else
                    $selected="";

            $privilegios ="";
            $privilegios ="  (";
            if($value->create==1)
                $privilegios .= "Crear, ";
            if($value->read==1)
                $privilegios .= "Leer, ";
            if($value->update==1)
                $privilegios .= "Actualizar, ";
            if($value->delete==1)
                $privilegios .= "Eliminar, ";
            if($value->create_user==1)
                $privilegios .= "Crear Usuario, ";
            if($value->authorize==1)
                $privilegios .= "Autorizar Presupuesto, ";
            $privilegios = substr($privilegios,0,-2);
            $privilegios .= ")";



            $option[]= '<option value="'.$value->id.'"  '.$selected.'>'.$value->name.$privilegios.'</option> ';
        }
        return $option;
 /*       foreach( $lista as $value)
        {
            $option[]= '<option value="'.$value->id.'">'.$value->name.'</option> ';
        }
        return $option;

*/

    }
}

