<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $user_image_route.$image?>" class="img-circle" alt="User Image" />
                <!--img src="<php echo 'foto.jpg' ?>" class="img-circle" alt="User Image" /-->
            </div>

            <div class="pull-left info">
                <p>Hello, <?php echo $_SESSION['session']->f_name; ?></p>
                <!--p>Hola, < ?php echo $fila[1]; ?></p-->
                <!--a href="#"--><i class="fa fa-circle text-success"></i> Online<!--/a-->
                <!--a href="#"><i class="fa fa-circle text-success"></i> <php echo 'status' ?></a-->
            </div>
        </div>

        <!-- search form >
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="index2.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Presupuestos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Nuevo</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Verificar</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Avanzado</a></li>
                </ul>
            </li>
            <?php if($_SESSION['session']->create_user=='1'){ ?>
            <li>
                <a href="usersv_list.php">
                    <i class="glyphicon glyphicon-user"></i> <span>Usuario</span>
                </a>
                <ul>
                </ul>
            </li>
            <?php } ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>