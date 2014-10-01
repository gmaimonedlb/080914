<?php
error_reporting('E_ALL');
require('includes/security.php');
if($_SESSION['session']->create_user!='1') { echo "<script> alert('No tiene los privilegios necesarios'); window.location = 'index2.php'</script>"; die();}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Asignar Clientes | DLB GROUP Worldwide</title>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <?php

    require('clientesc.php');
    require('usersc.php');
    $userc = new usersc();
    $clientesc = new clientesc();
    $user = $userc->busca_user($_REQUEST['id']);
    $lista_clientes = $clientesc->lista_clientes($_REQUEST['id']);

    ?>
</head>
<body class="skin-blue">
<?php include 'includes/header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php include 'includes/asides.php'; ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Asignar Clientes
                <small>DLB GROUP worldwide</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index2.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="usersv_list.php">Usuarios</a></li>
                <li class="active">Asignar Clientes</li>
            </ol>
        </section>

<!--*********************** Main content ***********************-->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-7">
                    <!-- Input addon -->
                    <div class="box box-info">
                        <div class="box-header"><h3 class="box-title">Usuario</h3></div>
                        <div class="box-body">

                            <!-- form start -->
                                <div class="box-body">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo $user->f_name . "&nbsp;" . $user->l_name ?>" disabled>
                                    </div>
                                    <br/>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user->email?>" disabled>
                                        <input type="hidden" name="email_old" id="email_old" value="<?php echo $user->email ?>" >
                                    </div>
                                    <br/>
                                    <form role="form" id="user-client" name="user-client" action="#" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_user" id="id_user" value="<?php echo $user->user_id ?>" >

                                    <div class="box box-primary page-scroll">
                                    <div class="box-body">
                                        <!-- Minimal red style --><h3 class="box-title">Clientes</h3>
                                        <div class="form-group">
                                            <?php echo $value->id_user ?>
                                            <?php foreach($lista_clientes as $value){ echo $value; } ?>
                                        </div>
                                    </div><!-- /.box-body -->
                                   </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info btn-sm pull-right" style="width:150px">Guardar</button><br/>
                                    </div>
                                </div><!-- /.box-body -->
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box-info -->
                </div><!--/.col (left) -->
                <!-- right column -->
            </div><!-- /.row -->            
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
    
    <!-- jQuery 2.0.2 -->
    <script src="js/jquery.2.0.2.min.js"></script>
    <script src="errores.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/AdminLTE/demo.js" type="text/javascript"></script>        
</body>
</html>

<script type="application/javascript">
    $("#user-client").submit(function(e)
    {
        var formObj = $(this);
        var formURL = "funciones_ajax.php?func=9";
        //   var formURL = formObj.attr("action");

        if(window.FormData !== undefined)  // for HTML5 browsers
        {

            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: "POST",
                data:  formData,
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR)
                {
                    if(data!=1) alert( error[data]);
                    if(data==1){ alert('Usuario Editado'); location.reload(); }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
            e.preventDefault();
        }
        else  //for older browsers
        {
            //generate a random id
            var  iframeId = "unique" + (new Date().getTime());

            //create an empty iframe
            var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

            //hide it
            iframe.hide();

            //set form target to iframe
            formObj.attr("target",iframeId);

            //Add iframe to body
            iframe.appendTo("body");
            iframe.load(function(e)
            {
                var doc = getDoc(iframe[0]);
                var docRoot = doc.body ? doc.body : doc.documentElement;
                var data = docRoot.innerHTML;
                //data return from server.

            });

        }

    });
</script>
