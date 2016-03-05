<?php
namespace Cirici\AdminLTE\Renderer;

use Cake\Filesystem\File;
use Gourmet\KnpMenu\Menu\MenuItem;
use Symfony\Component\Yaml\Parser;

/**
 * A helper class for creating KNPMenus from yaml files.
 *
 * @author  Òscar Casajuana <oscar@cirici.com>
 * @copyright 2016 Cirici New Media https://cirici.com
 */
class YamlMenuParser
{
    /**
     * The loaded instance of MenuItem.
     *
     * @var Gourmet\KnpMenu\Menu\MenuItem
     */
    public $menu;

    /**
     * The Yaml Parser instance
     *
     * @var Symfony\Component\Yaml\Parser
     */
    protected $parser;

    /**
     * The loaded File instance
     *
     * @var Cake\Filesystem\File
     */
    protected $file;

    /**
     * You can easily parse the menu just by initiating the class, passing both
     * the MenuItem instance and the file to be parsed.
     *
     * @param MenuItem $menu The MenuItem instance.
     * @param string   $file The yaml file to be parsed.
     * @param string   $path Path where the yaml is stored. CONFIG by default.
     */
    public function __construct(MenuItem $menu, $file = null, $path = CONFIG)
    {
        $this->menu = $menu;
        $this->parser = new Parser();

        if (!empty($file)) {
            $this->load($file, $path)->build();
        }
    }

    /**
     * Loads a yaml file creating a File instance for it.
     *
     * @param  string $file The file to be loaded.
     * @param  string $path Path where the yaml is stored. CONFIG by default.
     * @return YamlMenuParser
     */
    public function load($file, $path = CONFIG)
    {
        $this->file = new File($path . $file);

        return $this;
    }

    /**
     * Parses the menu and builds it from the parsed result.
     *
     * @return YamlMenuParser
     */
    public function build()
    {
        $parsed = $this->parser->parse($this->file->read());

        foreach ($parsed as $name => $properties) {
            $this->addChild($name, $properties);
        }

        return $this;
    }

    /**
     * Method to build the menu from the yaml file.
     *
     * @param string $name       Name of the menu child to be added.
     * @param array  $properties Properties of the menu item.
     */
    protected function addChild($name, $properties)
    {
        if (!empty($properties['children'])) {
            $children = $properties['children'];
            unset($properties['children']);
        }

        $menu = $this->menu;
        $this->menu = $this->menu->addChild($name, $properties);

        if (isset($children)) {
            foreach ($children as $childName => $childProperties)  {
                $this->addChild($childName, $childProperties);
            }
        }

        $this->menu = $menu;

        return $this;
    }
}
