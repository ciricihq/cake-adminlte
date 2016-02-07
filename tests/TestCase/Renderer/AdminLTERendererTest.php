<?php
namespace Cirici\AdminLTE\Test\Renderer;

use Cake\TestSuite\TestCase;
use Cirici\AdminLTE\Renderer\AdminLTERenderer;
use Knp\Menu\ItemInterface;

class AdminLTERendererTest extends TestCase
{
    protected $request = null;
    protected $matcher = null;
    protected $renderer = null;

    public function setUp()
    {
        $this->request = $this->getMock(
            'Cake\Network\Request'
        );

        $this->matcher = $this->getMock(
            'Gourmet\KnpMenu\Menu\Matcher\Matcher',
            null,
            [$this->request]
        );

        $this->renderer = new AdminLTERenderer($this->request);
    }

    public function tearDown()
    {
        unset($this->request, $this->matcher, $this->renderer);
    }

    protected function getProtectedProperty($name)
    {
        $class = new \ReflectionClass('Cirici\AdminLTE\Renderer\AdminLTERenderer');
        $property = $class->getProperty($name);
        $property->setAccessible(true);

        return $property->getValue($this->renderer);
    }

    protected function runProtectedMethod($name, array $args = [])
    {
        $class = new \ReflectionClass('Cirici\AdminLTE\Renderer\AdminLTERenderer');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($this->renderer, $args);
    }

    public function testConstructSetsDefaults()
    {
        $this->renderer = new AdminLTERenderer($this->request);

        $options = $this->getProtectedProperty('defaultOptions');

        $this->assertEquals('active', $options['currentClass']);
        $this->assertEquals('treeview', $options['branch_class']);
        $this->assertTrue($options['allow_safe_labels']);
    }

    public function testConstructOverwritesDefaults()
    {
        $overwrite = [
            'currentClass' => 'testcurrent',
            'branch_class' => 'testbranch',
            'allow_safe_labels' => false
        ];

        $this->renderer = new AdminLTERenderer($this->request, $overwrite);

        $options = $this->getProtectedProperty('defaultOptions');

        $this->assertEquals('testcurrent', $options['currentClass']);
        $this->assertEquals('testbranch', $options['branch_class']);
        $this->assertFalse($options['allow_safe_labels']);
    }

    public function testAddIconSkipsIfNoIconDefined()
    {
        // $item = $this->getMock(
        //     'Knp\Menu\ItemInterface',
        //     null,
        //     ['test']
        // );
        $this->markTestIncomplete('Incomplete');
    }

    public function testAddIcon()
    {
        $this->markTestIncomplete('Incomplete');
    }

    public function testStyleSublist()
    {
        $this->markTestIncomplete('Incomplete');
    }

    public function testAddRootClass()
    {
        $this->markTestIncomplete('Incomplete');
    }
}
