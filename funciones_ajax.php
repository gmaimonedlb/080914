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


}