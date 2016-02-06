AdminLTE theme for CakePHP 3
============================

Installation
------------

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```bash
composer require ciricihq/AdminLTE
```

### Installing dependencies

Currently this theme uses NPM to install external dependencies such as bootstrap,
fontawesome or the AdminLTE itself.

To install all the dependencies, just run (within the plugin folder):

```bash
npm install && ./node_modules/gulp/bin/gulp.js
```

Configuration
-------------

First you need to load the plugin. To do so, edit your `bootstrap.php` file and
add line below:

```php
Plugin::load('AdminLTE', ['bootstrap' => true]);
```

After that, you can easily use the AdminLTE template making your controllers
extend the AdminLTE `AppController`:

```php
use Cirici\AdminLTE\Controller\AppController as BaseController;

class MyController extends BaseController
{

}
```

License
-------

Created by Òscar Casajuana for Cirici New Media

    AdminLTE theme for CakePHP 3

    Copyright (C) 2016 Òscar Casajuana

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
