<?php
namespace Cirici\AdminLTE\Test\TestCase\Renderer;

use Cake\Core\Plugin;
use Cake\TestSuite\TestCase;
use Cirici\AdminLTE\Renderer\AdminLTERenderer;
use Cirici\AdminLTE\Renderer\YamlMenuParser;
use Gourmet\KnpMenu\Menu\MenuFactory;
use Gourmet\KnpMenu\Menu\MenuItem;

/**
 * YamlMenuParser tests
 *
 * @author  Òscar Casajuana <oscar@cirici.com>
 * @copyright 2016 Cirici New Media https://cirici.com
 * @coversDefaultClass Cirici\AdminLTE\Renderer\YamlMenuParser
 */
class YamlMenuParserTest extends TestCase
{
    protected $request = null;
    protected $renderer = null;
    protected $menu = null;

    /**
     * setUp method.
     *
     * @coversNothing
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->request = $this->getMock(
            'Cake\Network\Request'
        );
        $this->renderer = new AdminLTERenderer($this->request);
        $this->menu = new MenuItem('test', new MenuFactory());
    }

    /**
     * tearDown method.
     *
     * @coversNothing
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->request, $this->renderer, $this->menu);
    }

    /**
     * Tests construct which calls load and build when passing
     * a file to it.
     *
     * @covers ::__construct
     * @covers ::load
     * @covers ::build
     * @covers ::addChild
     * @return void
     */
    public function testLoadAndBuild()
    {
        $expected = <<<HTML
<ul class="test">
  <li class="header active first">
    <span>MENU</span>
  </li>
  <li class="last treeview">
    <a href="/admin/posts"><i class="fa fa-file-text-o"></i><span>Posts</span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu menu_level_1">
      <li class="first">
        <a href="/admin/posts">Index</a>
      </li>
      <li class="last">
        <a href="/admin/posts/add">New</a>
      </li>
    </ul>
  </li>
</ul>

HTML;
        $path = Plugin::path('AdminLTE') . 'tests' . DS . 'test_files' . DS . 'config' . DS;
        new YamlMenuParser($this->menu, 'menu.yaml', $path);

        $this->assertEquals($expected, $this->renderer->render($this->menu));
    }
}
