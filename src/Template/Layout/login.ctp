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
<body class="hold-transition skin-black login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/admin"><b>Admin</b>Metropolitan</a>
        </div>
        <?= $this->fetch('content'); ?>
    </div>
    <?= $this->fetch('script'); ?>
</body>
</html>
