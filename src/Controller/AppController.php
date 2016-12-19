<?php
namespace Cirici\AdminLTE\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    /**
     * {@inheritdoc}
     *
     * @var array
     * @link http://book.cakephp.org/3.0/en/controllers.html#configuring-helpers-to-load
     */
    public $helpers = [
        'Gourmet/KnpMenu.Menu',
        'Breadcrumbs'
    ];

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Gourmet/KnpMenu.Menu');
    }

    /**
     * {@inheritdoc}
     *
     * @param \Cake\Event\Event $event An Event instance.
     * @return \Cake\Network\Response|null
     * @link http://book.cakephp.org/3.0/en/controllers.html#request-life-cycle-callbacks
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->layout('Cirici/AdminLTE.admin');

        return null;
    }
}
