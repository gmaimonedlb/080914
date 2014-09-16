<?php error_reporting(E_ALL ^ E_NOTICE); session_start();
if($_SESSION['session']->create_user!='1') { echo "<script> alert('No tiene los privilegios necesarios'); window.location = 'index2.php'</script>"; die();}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>AdminLTE | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <?php
    require('cargosc.php');
    require_once('tiposc.php');
    $cargos = new cargosc();
    $lista_cargos = $cargos->genera_select_cargos();
    $tipos = new tiposc();
    $lista_tipos = $tipos->genera_select_tipos();
    //var_dump($lista_tipos);
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
                Registro de Usuario
                <small>DLB GROUP worldwide</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="usersv_list.php">Usuarios</a></li>
                <li class="active">Crear</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-7">

                    <!-- Input addon -->
                    <div class="box box-info">
                        <div class="box-header"><h3 class="box-title">Datos</h3></div>
                        <div class="box-body">

                            <!-- form start -->
                            <form role="form" id="cuser" name="cuser" action="#" method="POST" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Nombre" id="f_name" name="f_name">
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Apellido" id="l_name" name="l_name">
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" placeholder="Email @dlbgroup.com" id="email" name="email">
                                    </div>
                                    <br/>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <br/>
                                    <!-- select -->
                                    <div class="form-group">
                                        <!--label>Select</label-->
                                        <label for="id_carg">Cargo</label>
                                        <select class="form-control" id="id_carg" name="id_carg">
                                            <option value="" selected>Seleccione</option>
                                            <?php foreach($lista_cargos as $value){
                                                echo $value;
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_tipo">Tipo de Usuario</label>
                                        <select class="form-control" id="id_tipo" name="id_tipo">
                                            <option value="" selected>Seleccione</option>
                                            <?php foreach($lista_tipos as $value){
                                                echo $value;
                                            } ?>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Foto de Perfil</label>
                                        <input type="file" id="user_img" name="user_img">
                                        <p class="help-block">(215px x 215px)</p>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info btn-sm pull-right" style="width:150px ">Guardar</button>
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
    $("#cuser").submit(function(e)
    {
        var formObj = $(this);
        var formURL = "funciones_ajax.php?func=3";
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
                    if(data==1){ alert('Usuario Creado'); window.location = 'usersv_list.php'; }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
            e.preventDefault();
        }
        else  //for olden browsers
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