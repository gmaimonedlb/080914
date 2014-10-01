<?php require('includes/security.php');
if($_SESSION['session']->create_user!='1') { echo "<script> alert('No tiene los privilegios necesarios'); window.location = 'index2.php'</script>"; die();}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DLB GROUP Worldwide | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <?php
        include ('usersm.php');
        $usersm = new usersm();
        $listado= $usersm->lista_usuarios();
        ?>
    </head>
    <body class="skin-blue">
        <?php include 'includes/header.php'; ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include 'includes/asides.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        USUARIOS
                        <small>DLB GROUP worldwide</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Listado de Usuarios DLB GROUP Worldwide</h3>
                                    <a href="usersv_create.php" class="btn btn-default pull-right" style="margin-top:9px; margin-right: 23px;"><i class="fa fa-users"></i> Nuevo</a>
                                </div><! -- /.box-header - ->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>Tipo de Usuario</th>
                                                <th>CARGO</th>
                                                <th>DIRECCI&Oacute;N DE CORREO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($listado as $value){ ?>
                                            <tr>
                                                <td><!--a href="usersv_edit.php?id='< ?php echo $id ?>'"--><?php echo $value->f_name." ".$value->l_name?><!--/a--></td>
                                                <td><?php echo $value->tipo_usu?> </td>
                                                <td><?php echo $value->cargo?></td>
                                                <td><?php echo $value->email?></td>
                                                <td><a href="usersv_edit.php?id=<?php echo $value->user_id ?>" class="btn btn-warning btn-xs">Editar</a>&nbsp;
                                                    <a class="btn btn-danger btn-xs" onclick="borrar(<?php echo $value->user_id?>)">Borrar</a>
                                                    <a href="usersv_edit_clients.php?id=<?php echo $value->user_id?>" class="btn btn-primary btn-xs">Asignar Clientes <i class="fa fa-plus"></i></a>

                                                </td>
                                            </tr>
                                            <?php } ?>




                                            <!--tr>
                                                <td><a href="read_user.php?id='< ?php echo $id ?>'">nombre</a></td>
                                                <td>ID</td>
                                                <td>cargo</td>
                                                <td>email</td>
                                                <td><a href="update_user.php" class="btn btn-warning btn-xs">Editar</a>&nbsp;
                                                    <a class="btn btn-danger btn-xs">Borrar</a>
                                                </td>
                                            </tr-->
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.2.0.2.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->

        <script src="errores.js"></script>
        <script type="text/javascript">
            function borrar(id)
            {
                $.ajax({
                    url: "funciones_ajax.php",
                    type: "POST",
                    data:  {'id':id , 'func':5},
                    cache: false,
                    success: function(data, textStatus, jqXHR)
                    {
                        if(data==0) alert('Usuario / Contrasena Invalido')
                        if(data==1) location.reload();
                        if(data!=0 && data !=1) alert(error[data])
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                    }
                });
            }
            $(function() {
               /* $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                }); */
            });
        </script>

    </body>
</html>
