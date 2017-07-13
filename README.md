AdminLTE theme for CakePHP 3
============================

[![Build status][build svg]][build status]
[![Code coverage][coverage svg]][coverage]
[![License][license svg]][license]
[![Latest stable version][releases svg]][releases]
[![Total downloads][downloads svg]][downloads]
[![Code climate][climate svg]][climate]

Installation
------------

You can install this plugin into your CakePHP application using [composer][composer].

The recommended way to install composer packages is:

~~~bash
composer require ciricihq/adminlte
~~~

### Installing dependencies

Currently this theme uses [NPM][npm] to install external dependencies such as bootstrap,
fontawesome or the AdminLTE itself.

To install all the dependencies, just run (within the plugin folder):

~~~bash
npm install && ./node_modules/gulp/bin/gulp.js
~~~

Configuration
-------------

First you need to load the plugin. To do so, edit your `bootstrap.php` file and
add line below:

~~~php
Plugin::load('Cirici/AdminLTE', ['bootstrap' => true]);
~~~

After that, you can easily use the AdminLTE template making your controllers
extend the AdminLTE `AppController`:

~~~php
use Cirici\AdminLTE\Controller\AppController as BaseController;

class MyController extends BaseController
{

}
~~~

Usage
-----

First of, take a look to the `bootstrap.php` file to see what can you configure
with `Configure`.

To load your custom configurations you can obviously use `Configure::write` where
you need, but the recommended way is creating a `adminlte.php` file under your
`CONFIG` folder (usually `/config`):

~~~php
<?php
// /config/adminlte.php
return [
    'AdminLTE' => [
        'texts' => [
            'logo' => '<b>Awesome</b>Admin'
        ]
    ]
];
~~~

### Login template

A login template and layout are included too. To use them, simply render the
login Template from you `login` method:

~~~php
// some kind of users Controller
public function logic()
{
    // [...]
    // Your login logic

    $this->render('Cirici/AdminLTE./Admin/Users/login');
}
~~~

### Menus

This plugin uses [KnpMenu][KnpMenu] for managing its menus and also includes a
Yaml parser so you can easily create your menus with just three lines of code and
a yaml file:

~~~php
use Cake\Event\EventManager;
use Cirici\AdminLTE\Renderer\YamlMenuParser;

EventManager::instance()->on('AdminLTE.menu.sidebar', function ($event, $menu) {
    $yaml = new YamlMenuParser($menu, 'admin_menu_sidebar.yaml');
});
~~~

With a yaml file like this one:

~~~yaml
Settings:
  uri: '#'
  attributes:
    icon: gears
  children:
    Users:
      uri: /admin/users
      attributes:
        icon: users
      children:
        Add user:
          uri: /admin/users/add
          attributes:
            icon: user-plus
    Roles:
      uri: /admin/roles
      attributes:
        icon: suitcase
~~~

> Currently there's only the `sidebar` menu bar defined in the template.

Note that there's a special attribute `icon` so you can easily display
[FontAwesome][FontAwesome] icons on your menu. Just use the icon name
and the `AdminLTERenderer` will do the rest.

If you're setting menu items using php you would do something like this:

~~~php
$posts = $menu->addChild('Posts', [
    'uri' => ['_name' => 'posts.admin.index'],
    'icon' => 'newspaper-o'
]);
$posts->addChild('Add posts', [
    'uri' => ['_name' => 'posts.admin.add'],
    'icon' => 'plus'
]);
~~~

### Crumbs

Add crumbs using the `BreadcrumbsHelper::add` method:

~~~php
<?php
$this->Breadcrumbs->add('Posts', '/posts');
$this->Breadcrumbs->add($yourCurrentPost->title);
~~~

### View blocks

Many sections of the layout can be managed just defining some view blocks.

For this reason, we recommend creating a custom layout which your views will extend.

Create an `admin.ctp` file wherever you want, add there your custom AdminLTE
view blocks, and then make your views extend that layout:

~~~php
<?php
// src/Templates/admin.ctp
$this->start('AdminLTE.user.sidebar');
echo 'Hello ' . $this->Session->read('Auth.User.username') . '!';
$this->end('AdminLTE.user.small');
~~~

And then, in your views:

~~~php
<?php
$this->extend('/admin');
~~~

Here are all the currently defined view blocks:

- `subtitle`
- `AdminLTE.user.small`
- `AdminLTE.user.detail`
- `AdminLTE.user.sidebar`
- `AdminLTE.sidebar.right`

Don't forget to check out the official AdminLTE repository to know how to
properly define each section.

License
-------

Created by Òscar Casajuana for Cirici New Media

    AdminLTE theme for CakePHP 3
    Copyright (C) 2016 Òscar Casajuana

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

[composer]: https://getcomposer.org
[npm]: https://nodejs.org
[KnpMenu]: https://github.com/KnpLabs/KnpMenu
[FontAwesome]: http://fortawesome.github.io/Font-Awesome/icons/

[build status]: https://travis-ci.org/ciricihq/cake-adminlte
[coverage]: https://codecov.io/gh/ciricihq/cake-adminlte
[license]: https://github.com/ciricihq/cake-adminlte/blob/master/LICENSE.md
[releases]: https://github.com/ciricihq/cake-adminlte/releases
[downloads]: https://packagist.org/packages/ciricihq/adminlte
[climate]: https://codeclimate.com/github/ciricihq/cake-adminlte

[build svg]: https://img.shields.io/travis/ciricihq/cake-adminlte/master.svg?style=flat-square
[coverage svg]: https://img.shields.io/codecov/c/github/ciricihq/cake-adminlte/master.svg?style=flat-square
[license svg]: https://img.shields.io/github/license/ciricihq/cake-adminlte.svg?style=flat-square
[releases svg]: https://img.shields.io/github/release/ciricihq/cake-adminlte.svg?style=flat-square
[downloads svg]: https://img.shields.io/packagist/dt/ciricihq/adminlte.svg?style=flat-square
[climate svg]: https://img.shields.io/codeclimate/github/ciricihq/cake-adminlte.svg?style=flat-square
