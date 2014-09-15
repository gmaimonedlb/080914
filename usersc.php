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
    function logout_user($id)
    {

        if(isset($_COOKIE['session']))  setcookie('session', "", time()-3600);
        if(isset($_SESSION['session'])) session_destroy();
        echo 1;



    }
    function crear_user($data , $file=null)
    {

        if(isset($file) && $file!="" && $file != null && is_file($file))
        {
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $file["name"]);
            $extension = end($temp);
            if ((($file["type"] == "image/gif")
                    || ($file["type"] == "image/jpeg")
                    || ($file["type"] == "image/jpg")
                    || ($file["type"] == "image/pjpeg")
                    || ($file["type"] == "image/x-png")
                    || ($file["type"] == "image/png"))
                && ($file["size"] < 20000)
                && in_array($extension, $allowedExts)) {
                if ($file["error"] > 0) {
                    echo "Return Code: " . $file["error"] . "<br>";
                } else {
                    if (file_exists("img/users/" . $file["name"])) {
                        echo $file["name"] . " already exists. ";
                    } else {
                        move_uploaded_file($file["tmp_name"],
                            "img/users/" . $file["name"]);
                        $data['image']= $file["name"];

                    }
                }
            } else {
                echo "Invalid file";
            }
        }
        if(!is_null($this->usersm->crear_usuario($data)))
        {
            echo 1;
        }else{
            echo 0;
        }


    }
}


