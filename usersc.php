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

        if(isset($file) && $file!="" && $file != null )
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
                && in_array($extension, $allowedExts)) {
                if ($file["error"] > 0) {
                   // echo "Return Code: " . $file["error"] . "<br>";
                    $error =  4;
                } else {
                  // if (!file_exists("img/users/" . $file["name"])) {
                       // echo "<script> alert(".$file["name"] . " already exists.') </script>";
                   // } else {
                        $error = 0;
                       move_uploaded_file($file["tmp_name"],"img/users/" . $file["name"]);
                        $data['image']= $file["name"];

                //    }
                }
            } else {
                $error =  4;

                echo $error;
           }
        }
        if($error!=4)
            echo $this->usersm->crear_usuario($data);

    }
    function busca_user($id)
    {
        $user= $this->usersm->busca_usuario($id);
        return $user[0];

    }
    function edit_user($data , $file=null, $id , $switch = false)
    {
        if(isset($file) && $file!="" && $file != null )
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
                && in_array($extension, $allowedExts)) {
                if ($file["error"] > 0) {
                    // echo "Return Code: " . $file["error"] . "<br>";
                    $error =  4;
                } else {
                    // if (!file_exists("img/users/" . $file["name"])) {
                    // echo "<script> alert(".$file["name"] . " already exists.') </script>";
                    // } else {
                    $error = 0;
                    move_uploaded_file($file["tmp_name"],"img/users/" . $file["name"]);
                    $data['image']= $file["name"];

                    //    }
                }
            } else {
                $error =  4;

                echo $error;
            }
        }else{
            $error=0;
        }
        if($error!=4)
        {
            $verifica_correo = $this->usersm->verifica_correo($data['email']);
            if($verifica_correo->num_rows<1 || $switch)
            {
                echo $this->usersm->actualiza_usuario2($data, $id);
            }else{
                echo 2;
            }
        }


    }
    function delete_user($id)
    {
        if($_SESSION['session']->user_id != $id)
        {
            if($_SESSION['session']->delete=='1')
                $query = $this->usersm->borrar_ususario($id);
            else
                $query = 0;
            return $query;
        }else{
            echo 6;
        }


    }

}


