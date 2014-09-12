<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 12:40 PM
 */

class usersc // users controller
{
    var $usersm;

    function __construct()
    {
        session_start();
        require_once('usersm.php');
        $this->usersm = new usersm();

    }
    function login_user($user, $password)
    {
        if(is_null($this->usersm->login($user, $password)))
        {
            echo 0;
            setcookie('session',"", time()-3600);
        }else{
            if(isset($_REQUEST['remember_me']))  setcookie('session', json_encode($this->usersm->login($user, $password)), time() + 1*24*60*60);
            $_SESSION['session'] = $this->usersm->login($user, $password);
            echo 1;
        }


    }
}