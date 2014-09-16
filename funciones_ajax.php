<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 4:14 PM
 */
require_once('usersc.php');
if(isset($_REQUEST['func']))
{
    if($_REQUEST['func']==1)  // autentica al usuario
    {
        $usersc = new usersc();
        $login = $usersc->login_user($_REQUEST['email'],$_REQUEST['password']);

    }
    if($_REQUEST['func']==2) // logout del usuario
    {
        $usersc = new usersc();
        $login = $usersc->logout_user($_REQUEST['user_id']);
    }
    if($_REQUEST['func']==3) // toma los datos del formulario crear usuarios y lo guarda en la tabla
    {
        $usersc = new usersc();

        $data = array();
        if(isset($_REQUEST['f_name'])) $data['f_name']= trim($_REQUEST['f_name']);
        if(isset($_REQUEST['l_name']))$data['l_name']= trim($_REQUEST['l_name']);
        if(isset($_REQUEST['email']))$data['email']= trim($_REQUEST['email']);
        if(isset($_REQUEST['id_carg']))$data['id_carg']= trim($_REQUEST['id_carg']);
        if(isset($_REQUEST['password']))$data['password']= trim($_REQUEST['password']);
        if(isset($_REQUEST['id_tipo'])) $data['id_tipo']= trim($_REQUEST['id_tipo']);
        if(isset($_FILES["user_img"]))$file = $_FILES["user_img"]; else $file = null;

        ($usersc->crear_user($data , $file));
    }
    if($_REQUEST['func']==4) // toma los datos del formulario editar usuarios y lo guarda en la tabla
    {
        $usersc = new usersc();

        $data = array();
        if(isset($_REQUEST['f_name'])) $data['f_name']= trim($_REQUEST['f_name']);
        if(isset($_REQUEST['l_name']))$data['l_name']= trim($_REQUEST['l_name']);
        if(isset($_REQUEST['email']))$data['email']= trim($_REQUEST['email']);
        if(isset($_REQUEST['id_carg']))$data['id_carg']= trim($_REQUEST['id_carg']);
        if(isset($_REQUEST['password']))$data['password']= trim($_REQUEST['password']);
        if(isset($_REQUEST['id_tipo'])) $data['id_tipo']= trim($_REQUEST['id_tipo']);
        if(isset($_FILES["user_img"])&& $_FILES["user_img"]['tmp_name']!="")$file = $_FILES["user_img"]; else $file = null;

        ($usersc->edit_user($data , $file, $_REQUEST['id']));
    }

}