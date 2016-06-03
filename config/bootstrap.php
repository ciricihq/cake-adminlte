<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;

Plugin::load('Gourmet/KnpMenu');

Configure::write('AdminLTE', [
    'links' => [
        'logout' => null,
        'profile' => false,
        'forgot' => false,
        'dashboard' => '/admin'
    ],
    'texts' => [
        'forgot' => 'I forgot my password',
        'logo-mini' => '<b>A</b>LT',
        'logo' => '<b>Admin</b>LTE'
    ]
]);

if (file_exists(CONFIG . 'adminlte.php')) {
    Configure::load('adminlte');
}
