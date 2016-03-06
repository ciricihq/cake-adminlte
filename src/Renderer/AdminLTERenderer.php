<?php
namespace Cirici\AdminLTE\Renderer;

use Cake\Network\Request;
use Gourmet\KnpMenu\Menu\Matcher\Matcher;
use Gourmet\KnpMenu\Menu\Renderer\ListRenderer as GourmetListRenderer;
use Knp\Menu\ItemInterface;

class AdminLTERenderer extends GourmetListRenderer
{
    /**
     * {@inheritdoc}
     *
     * Modified to add necessary classes for AdminLTE.
     *
     * @param Cake\Network\Request $request        Cake request.
     * @param array                $defaultOptions Default options for the menu.
     * @param string               $charset        Charset.
     */
    public function __construct(Request $request, array $defaultOptions = [], $charset = null)
    {
        $defaultOptions += [
            'currentClass' => 'active',
            'branch_class' => 'treeview',
            'allow_safe_labels' => true
        ];

        $matcher = new Matcher($request);

        parent::__construct($matcher, $defaultOptions, $charset);
    }

    /**
     * Renders a menu.
     *
     * Modified to automatically add a class to the root item based on the
     * menu name.
     *
     * @param  ItemInterface $item    The menu item.
     * @param  array         $options The options to render the item.
     * @return string
     */
    public function render(ItemInterface $item, array $options = [])
    {
        $this->addRootClass($item, $options);

        return parent::render($item, $options);
    }

    /**
     * {@inheritdoc}
     *
     * Overwriten to add shorthand methods like easy icons and AdminLTE specific
     * styles (i.e. for subtrees)
     *
     * @param  ItemInterface $item    The menu item.
     * @param  array         $options The options to render the item.
     * @return string
     */
    protected function renderItem(ItemInterface $item, array $options)
    {
        $this->addIcon($item, $options);
        $this->styleSublist($item, $options);

        return parent::renderItem($item, $options);
    }

    /**
     * Shorthand for adding FontAwesome icons to the menus.
     *
     * Takes an `icon` attribute defined for the item and converts it to a
     * `<i class="fa fa-%s">` where `%s` is the defined icon.
     *
     * @param  ItemInterface $item     The menu item.
     * @param  array         &$options Options passed to the menu.
     * @return void
     */
    protected function addIcon(ItemInterface $item, array &$options)
    {
        if (!$item->getAttribute('icon')) {
            return;
        }

        $attributes = $item->getAttributes();

        $item->setExtra('safe_label', true);

        $item->setLabel(
            sprintf(
                '<i class="fa fa-%s"></i><span>%s</span>',
                $attributes['icon'],
                $item->getLabel()
            )
        );

        unset($attributes['icon']);
        $item->setAttributes($attributes);
    }

    /**
     * Adds the `.treeview-menu` required class (by AdminLTE) for sublists +
     * the unfold arrow icon.
     *
     * @param  ItemInterface $item     The menu item.
     * @param  array         &$options The menu options.
     * @return void
     */
    protected function styleSublist(ItemInterface $item, array &$options)
    {
        if (!$item->isRoot() && $item->hasChildren()) {
            $item->setChildrenAttribute('class', 'treeview-menu');

            $item->setExtra('safe_label', true);

            $item->setLabel(
                $item->getLabel() . '<i class="fa fa-angle-left pull-right"></i>'
            );
        }
    }

    /**
     * Adds the menu name as the root list class.
     *
     * @param ItemInterface $item     The item interface.
     * @param array         &$options Options passed to render.
     * @return void
     */
    protected function addRootClass(ItemInterface $item, array &$options)
    {
        $class = $item->getName();
        if ($item->getAttribute('class')) {
            $class = $item->getAttribute('class');
        }

        if ($item->isRoot()) {
            $item->setAttributes(compact('class'));
        }
    }
}
