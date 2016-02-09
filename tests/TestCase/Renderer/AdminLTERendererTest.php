<?php
namespace Cirici\AdminLTE\Test\TestCase\Renderer;

use Cake\Network\Request;
use Cake\TestSuite\TestCase;
use Cirici\AdminLTE\Renderer\AdminLTERenderer;
use Cirici\AdminLTE\Test\TestCase\ProtectedAccessorTrait;
use Gourmet\KnpMenu\Menu\MenuFactory;
use Gourmet\KnpMenu\Menu\MenuItem;

/**
 * AdminLTERenderer tests
 *
 * @author Òscar Casajuana <elboletaire@underave.net>
 * @coversDefaultClass Cirici\AdminLTE\Renderer\AdminLTERenderer
 */
class AdminLTERendererTest extends TestCase
{
    use ProtectedAccessorTrait;

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
     * Test __construct sets correct defaults.
     *
     * @covers ::__construct
     * @return void
     */
    public function testConstructSetsDefaults()
    {
        $this->renderer = new AdminLTERenderer($this->request);

        $options = $this->getProtectedProperty($this->renderer, 'defaultOptions');

        $this->assertEquals('active', $options['currentClass']);
        $this->assertEquals('treeview', $options['branch_class']);
        $this->assertTrue($options['allow_safe_labels']);
    }

    /**
     * Test __construct overwrites defaults.
     *
     * @covers ::__construct
     * @return void
     */
    public function testConstructOverwritesDefaults()
    {
        $overwrite = [
            'currentClass' => 'testcurrent',
            'branch_class' => 'testbranch',
            'allow_safe_labels' => false
        ];

        $this->renderer = new AdminLTERenderer($this->request, $overwrite);

        $options = $this->getProtectedProperty($this->renderer, 'defaultOptions');

        $this->assertEquals('testcurrent', $options['currentClass']);
        $this->assertEquals('testbranch', $options['branch_class']);
        $this->assertFalse($options['allow_safe_labels']);
    }

    /**
     * Tests addRootClass.
     *
     * @covers ::addRootClass
     * @covers ::addIcon
     * @covers ::render
     * @covers ::renderItem
     * @return void
     */
    public function testAddRootClass()
    {
        $expected = [
            'ul' => ['class' => 'test'],
            'li' => ['class' => 'active first last'],
            ['span' => true],
            'About'
        ];

        $this->menu->addChild('About');
        $result = $this->renderer->render($this->menu);

        $this->assertHtml($expected, $result);
    }

    /**
     * Tests addRootClass allowing custom classes.
     *
     * @covers ::addRootClass
     * @covers ::addIcon
     * @covers ::render
     * @covers ::renderItem
     * @depends testAddRootClass
     * @return void
     */
    public function testAddRootClassAllowsCustomClass()
    {
        $expected = [
            'ul' => ['class' => 'testing'],
            'li' => ['class' => 'active first last'],
            ['span' => true],
            'About'
        ];

        $this->menu->setAttribute('class', 'testing');

        $this->menu->addChild('About');
        $result = $this->renderer->render($this->menu);

        $this->assertHtml($expected, $result);
    }

    /**
     * Tests addIcon
     *
     * @covers ::addRootClass
     * @covers ::addIcon
     * @covers ::render
     * @covers ::renderItem
     * @depends testAddRootClass
     * @return void
     */
    public function testAddIcon()
    {
        $expected = [
            'ul' => ['class' => 'test'],
            'li' => ['class' => 'active first last'],
            ['span' => true],
            'i' => ['class' => 'fa fa-clock'],
            '/i',
            'About'
        ];

        $this->menu->addChild('About', ['attributes' => ['icon' => 'clock']]);

        $result = $this->renderer->render($this->menu);
        $this->assertHtml($expected, $result);
    }

    /**
     *
     * @covers ::addRootClass
     * @covers ::addIcon
     * @covers ::styleSublist
     * @covers ::render
     * @covers ::renderItem
     * @depends testAddRootClass
     * @depends testAddIcon
     * @return void
     */
    public function testStyleSublist()
    {
        $expected = <<<HTML
<ul class="test">
  <li class="active first last treeview">
    <span>About<i class="fa fa-angle-left pull-right"></i></span>
    <ul class="treeview-menu menu_level_1">
      <li class="active first last">
        <span>foo</span>
      </li>
    </ul>
  </li>
</ul>

HTML;
        $this->menu->addChild('About')->addChild('foo');

        $result = $this->renderer->render($this->menu);

        $this->assertEquals($expected, $result, true);
    }
}
