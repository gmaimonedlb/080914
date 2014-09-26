<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 4:14 PM
 */
session_start();
require_once('usersc.php');
require_once('departamentosc.php');
require_once('clientesc.php');

require('formkey.php');



if(isset($_REQUEST['func']))
{
    if($_REQUEST['func']==1)  // autentica al usuario
    {   $formKey = new formKey();
        if(!isset($_REQUEST['form_key']) || !$formKey->validate($_REQUEST['form_key']))
        {
            echo 5;
        }
        else
        {
            $usersc = new usersc();
            $login = $usersc->login_user($_REQUEST['email'],$_REQUEST['password']);
        }

    }
    if($_REQUEST['func']==2) // logout del usuario
    {
        $usersc = new usersc();
        $login = $usersc->logout_user($_REQUEST['user_id']);
    }
    if($_REQUEST['func']==3) // toma los datos del formulario crear usuarios y lo guarda en la tabla
    {
        $formKey = new formKey();
        if(!isset($_REQUEST['form_key']) || !$formKey->validate($_REQUEST['form_key']))
        {
           echo 5;
        }
        else
        {
            $data = array();
            if(isset($_REQUEST['f_name'])) $data['f_name']= trim($_REQUEST['f_name']);
            if(isset($_REQUEST['l_name']))$data['l_name']= trim($_REQUEST['l_name']);
            if(isset($_REQUEST['email']))$data['email']= trim($_REQUEST['email']);
            if(isset($_REQUEST['id_carg']))$data['id_carg']= trim($_REQUEST['id_carg']);
            if(isset($_REQUEST['password']))$data['password']= trim($_REQUEST['password']);
            if(isset($_REQUEST['id_tipo'])) $data['id_tipo']= trim($_REQUEST['id_tipo']);
            if(isset($_FILES["user_img"]['name']) && $_FILES['user_img']['name']!="")$file = $_FILES["user_img"]; else $file = null;
            $usersc = new usersc();
            $usersc->crear_user($data , $file);
        }


    }
    if($_REQUEST['func']==4) // toma los datos del formulario editar usuarios y lo guarda en la tabla
    {
        $formKey = new formKey();
        if(!isset($_REQUEST['form_key']) || !$formKey->validate($_REQUEST['form_key']))
        {
            echo 5;
        }
        else
        {
            if($_REQUEST['email_old']==$_REQUEST['email'])
            {
                $switch = true;
            }else{
                $switch = false;
            }
            $usersc = new usersc();
            $data = array();
            if(isset($_REQUEST['f_name'])) $data['f_name']= trim($_REQUEST['f_name']);
            if(isset($_REQUEST['l_name']))$data['l_name']= trim($_REQUEST['l_name']);
            if(isset($_REQUEST['email']))$data['email']= trim($_REQUEST['email']);
            if(isset($_REQUEST['id_carg']))$data['id_carg']= trim($_REQUEST['id_carg']);
            if(isset($_REQUEST['password']))$data['password']= trim($_REQUEST['password']);
            if(isset($_REQUEST['id_tipo'])) $data['id_tipo']= trim($_REQUEST['id_tipo']);
            if(isset($_FILES["user_img"])&& $_FILES["user_img"]['tmp_name']!="")$file = $_FILES["user_img"]; else $file = null;
            $usersc->edit_user($data , $file, $_REQUEST['id'], $switch);
        }

    }
    if($_REQUEST['func']==5) // recibe el id del usuario y lo elimina
    {
        if(isset($_REQUEST['id']))
        {
            $usersc = new usersc();
           echo $usersc->delete_user($_REQUEST['id']);
        }else{
            echo 0;
        }


    }
    if($_REQUEST['func']==6) //autosave presupuesto
    {
        var_dump($_REQUEST['interests']);
        var_dump($_REQUEST['interests1']);

    }
    if($_REQUEST['func']==7) //traer la data de un select
    {

        $departamentosc = new departamentosc();
        $listado_depar= $departamentosc->lista_departamentos();
        echo (json_encode($listado_depar));


    }
    if($_REQUEST['func']==8) //traer la data de un select
    {

        $departamentosc = new departamentosc();
        $listado_depar= $departamentosc->select_departamentos();


    }
    if($_REQUEST['func']==9) //actualiza la tabla cliente usuario borrando los clientes actuales y creando de cero los seleccionados
    {
        $data = array('data'=>$_REQUEST['id'], 'id_user'=>$_REQUEST['id_user']);
        $clientesc = new clientesc();
        $guarda = $clientesc->guardar($data);


    }
    if($_REQUEST['func']==10) //actualiza la tabla cliente usuario borrando los clientes actuales y creando de cero los seleccionados
    {
        $clientesc = new clientesc();

        $lista_clientes = $clientesc->lista_clientes($_REQUEST['id']);

var_dump($lista_clientes);


    }

}