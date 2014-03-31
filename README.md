# generator-naymspace-wp-plugin

> A [Yeoman](http://yeoman.io) generator that aims to make plugin development of any kind a breeze. 
>
> This is an **alpha release**. Nevertheless it will create an extremely opinionated plugin-structure for you. We believe that this is an excellent approach to wp-plugin-development and hope for contributions!
>
> As we will be creating more plugins for our customers in the future, we will add and extend new modules every now and then. We will try to actively promote the development of this plugin.

## Getting Started

    yo naymspace-wp-plugin

## Why should i use this?
This opinionated plugin-boilerplate has been written for ourselves, for developers. Therefore it's built to be easily understandable, maintainable and extendable. It will not just setup plugin meta-data, but structure your whole plugin and provide usefull modules which will guide you and make you encourage best practives. 

After the generator has done it's work, the plugin will be recognized by wordpress' plugin manager and you can immediately start developing.

## Yeoman did all his fancy magic, what now?

Now you will have to get your hands dirty and alter the index.php and the modules you want to use.

#### index.php

Please have a look at [wordpress' codex](https://codex.wordpress.org/Writing_a_Plugin#File_Headers), which explains how to setup a plugins metadata.
This is where your plugin's **options**, that you want to be configured via the Backend, go as well. You can add them to your plugin's Base::$options hash (in index.php):

    'someOption' => array(
        'id'    => '<%= namespace %>-someOption',
        'title' => 'Some description for the admins',
        'type'  => '[checkbox|text]'
    ),

You can retrieve the current value of your option in (almost) any place in your plugin via: 

    Helper::get_option('someOption');


Aside from that, you only have to care about which modules are loaded in the constructor.

## Modules
The goal of this project is to have separate modules for separate concerns. This way no unneccessary code has to be loaded.
For now there are:

#### The Helper
It's loaded automatically and contains some static methods to make your life easier. You should have a look!

#### Frontend
Shows you how to load scripts and styles!

#### Backend
Creates an options page in the backend, which renders all the options you specified in the plugin's index.php.

#### Database
This is just a stub. Please contribute!

## Goals of this project
* Make the wordpress plugin ecosystem a better place. No more 3000-lines-of-code-files!
* Be be sparing with resources: load and process things only when they are really needed to.
* Keep code maintain- and extendable via modules.
* Encourage best pratices.

## TODO
* Add more modules (AJAX)
* Add more functionality to the database-module

## License

[MIT](http://opensource.org/licenses/MIT)
