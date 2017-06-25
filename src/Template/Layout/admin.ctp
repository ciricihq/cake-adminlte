<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s">', Configure::read('App.language'));
    $this->end();
}

if (!$this->fetch('title') && Configure::read('App.title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

// Prepend some meta tags
$this->prepend('meta', $this->Html->meta('icon'));
$this->prepend('meta', $this->Html->meta('viewport', 'width=device-width, initial-scale=1'));
if (Configure::read('App.author')) {
    $this->prepend('meta', $this->Html->meta('author', null, [
        'name'    => 'author',
        'content' => Configure::read('App.author')
    ]));
}

// Prepend scripts required by the navbar
$this->prepend('script', $this->Html->script([
    '/Cirici/AdminLTE/vendor/jquery/dist/jquery.min.js',
    '/Cirici/AdminLTE/vendor/bootstrap/dist/js/bootstrap.min.js',
    '/Cirici/AdminLTE/vendor/AdminLTE/dist/js/app.min.js'
]));

// Styles
$this->prepend('css', $this->Html->css([
    '/Cirici/AdminLTE/vendor/fontawesome/css/font-awesome.min.css',
    '/Cirici/AdminLTE/vendor/ionicons/css/ionicons.min.css',
]));

$this->append('css', $this->Html->css([
    '/Cirici/AdminLTE/css/admin.css'
]));

?>
<!DOCTYPE html>
<?= $this->fetch('html'); ?>
<head>
    <?= $this->Html->charset(); ?>
    <title>
        <?= sprintf('%s | %s', $this->fetch('title'), Configure::read('App.title')); ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <?php
        // Meta
        echo $this->fetch('meta');

        echo $this->fetch('css');
    ?>
</head>
<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Configure::read('AdminLTE.links.dashboard') ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><?= Configure::read('AdminLTE.texts.logo-mini') ?></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?= Configure::read('AdminLTE.texts.logo') ?></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <?php if ($this->fetch('AdminLTE.user.small')) : ?>
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= $this->fetch('AdminLTE.user.small') ?>
                            </a>
                            <?php endif ?>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <?php if ($this->fetch('AdminLTE.user.detail')) : ?>
                                <li class="user-header">
                                    <?= $this->fetch('AdminLTE.user.detail'); ?>
                                </li>
                                <?php endif ?>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                <?php
                                $profile = Configure::read('AdminLTE.links.profile');
                                if ($profile) : ?>
                                    <div class="pull-left">
                                        <?=
                                            $this->Html->link(
                                                __d('AdminLTE', 'Profile'),
                                                $profile,
                                                ['class' => 'btn btn-default btn-flat']
                                            ); ?>
                                    </div>
                                <?php
                                endif;
                                ?>
                                    <div class="pull-right">
                                        <?=
                                            $this->Html->link(
                                                __d('AdminLTE', 'Sign out'),
                                                Configure::read('AdminLTE.links.logout'),
                                                ['class' => 'btn btn-default btn-flat']
                                            );
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <?php if ($this->fetch('AdminLTE.sidebar.right')) : ?>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                        <?php endif ?>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <?php if ($this->fetch('AdminLTE.user.sidebar')) : ?>
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <?= $this->fetch('AdminLTE.user.sidebar'); ?>
                </div>
                <?php endif ?>

                <!-- Sidebar Menu -->
                <?= $this->element('Cirici/AdminLTE.sidebar'); ?>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <section class="content-wrapper">
            <!-- Content Header (Page header) -->
            <header class="content-header">
                <h1>
                    <?= $this->fetch('title') ?>
                    <?php
                    if ($this->fetch('subtitle')) {
                        echo $this->Html->tag('small', $this->fetch('subtitle'));
                    }
                    ?>
                </h1>
                <?php
                    $this->Breadcrumbs->prepend(
                        '<i class="fa fa-dashboard"></i> Dashboard',
                        Configure::read('AdminLTE.links.dashboard')
                    );
                    echo $this->Breadcrumbs->render(['class' => 'breadcrumb']);
                ?>
            </header>

            <!-- Main content -->
            <section class="content">
                <?= $this->Flash->render(); ?>
                <?= $this->fetch('content'); ?>
            </section>
            <!-- /.content -->
        </section>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                <a href="https://cirici.com">by Cirici</a>
            </div>
            <!-- Default to the left -->
            <strong>
                Copyright &copy; <?= date('Y') ?> <a href="https://cirici.com">Cirici</a>.
            </strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <?php if ($this->fetch('AdminLTE.sidebar.right')) : ?>
        <aside class="control-sidebar control-sidebar-dark">
            <?= $this->fetch('AdminLTE.sidebar.right'); ?>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
        <?php endif ?>
    </div>
    <?= $this->fetch('script'); ?>
</body>
</html>
