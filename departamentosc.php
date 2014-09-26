<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 9/11/14
 * Time: 12:40 PM
 */

class departamentosc // users controller
{
    var $departamentosc;

    function __construct()
    {
        require_once('departamentosm.php');
        $this->departamentosm= new departamentosm();

    }
    function lista_departamentos()
    {
        $data= $this->departamentosm->lista_departamentos();
        $result[]= array('id'=>""  , 'nombre' =>"..");
        foreach($data as $value)
        {
            $result[]= array('id'=>$value->id , 'nombre' =>$value->nombre);

        }
        return $result;
    }
    function select_departamentos()
    {
        $data= $this->departamentosm->lista_departamentos();
        echo ("<option value =''>..</option>");

/*<div class="form-group">
                                            <?php echo $value->id_user ?>
<?php foreach($lista_clientes as $value){ echo $value; } ?>
</div>
*/


        foreach($data as $value)
        {
            echo ("<option value ='". $value->id."'>".$value->nombre."</option>");

        }
    }

    /*

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
            echo $this->departamentosc->crear_usuario($data);

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
            $verifica_correo = $this->departamentosc->verifica_correo($data['email']);
            if($verifica_correo->num_rows<1 || $switch)
            {
                echo $this->departamentosc->actualiza_usuario2($data, $id);
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
                $query = $this->departamentosc->borrar_ususario($id);
            else
                $query = 0;
            return $query;
        }else{
            echo 6;
        }


    }
    */

}


