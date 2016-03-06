<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;

Plugin::load('Gourmet/KnpMenu');

Configure::write('AdminLTE', [
    'links' => [
        'logout' => null,
        'profile' => false
    ]
]);

if (file_exists(CONFIG . 'adminlte.php')) {
    Configure::load('adminlte');
}
