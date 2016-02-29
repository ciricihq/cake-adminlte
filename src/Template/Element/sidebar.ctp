<?php
use Cake\Event\Event;
use Cirici\AdminLTE\Renderer\AdminLTERenderer;

$menu = $this->Menu->get('AdminLTE.sidebar', [
    'attributes' => [
        'class' => 'sidebar-menu'
    ]
]);

$this->eventManager()->dispatch(
    new Event('AdminLTE.menu.sidebar', $this, compact('menu'))
);

echo $this->Menu->render('AdminLTE.sidebar', [
    'renderer'  => new AdminLTERenderer($this->request)
]);
