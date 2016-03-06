<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;

Plugin::load('Gourmet/KnpMenu');

Configure::write('AdminLTE', [
    'links' => [
        'logout' => null,
        'profile' => false,
        'forgot' => false
    ],
    'texts' => [
        'forgot' => 'I forgot my password'
    ]
]);

if (file_exists(CONFIG . 'adminlte.php')) {
    Configure::load('adminlte');
}
