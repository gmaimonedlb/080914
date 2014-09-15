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
        $data = array();
        $data['f_name']= $_REQUEST['f_name'];
        $data['l_name']= $_REQUEST['l_name'];
        $data['email']= $_REQUEST['email'];
        $data['id_carg']= $_REQUEST['id_carg'];
        $data['password']= $_REQUEST['password'];
        $data['id_tipo']= $_REQUEST['id_tipo'];
        $file = $_FILES["user_img"];










    }

}