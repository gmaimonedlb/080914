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
    if($_REQUEST['func']==1)
    {
        $usersc = new usersc();
        $login = $usersc->login_user($_REQUEST['email'],$_REQUEST['password']);

    }

}