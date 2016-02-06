<?php
namespace Cirici\AdminLTE\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    public $components = [
        'Gourmet/KnpMenu.Menu'
    ];
    public $helpers = [
        'Gourmet/KnpMenu.Menu'
    ];

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->layout('AdminLTE.admin');
    }
}
