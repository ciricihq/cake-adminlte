<?php
namespace Cirici\AdminLTE\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

/**
 * Cirici\AdminLTE\Controller\AppController Test Case
 */
class AppControllerTest extends IntegrationTestCase
{
    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->get('/admin');
        $this->assertResponseOk();
        $this->assertTrue($this->_controller->components()->has('Menu'));
    }

    /**
     * Test beforeRender method
     *
     * @return void
     */
    public function testBeforeRender()
    {
        $this->get('/admin');
        $this->assertResponseOk();
        $this->assertResponseContains('<body class="hold-transition skin-black sidebar-mini">');
    }
}
