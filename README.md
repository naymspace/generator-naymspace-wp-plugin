# generator-naymspace-wp-plugin

> A [Yeoman](http://yeoman.io) generator that aims to make plugin creation a breeze. 
> 
> This is an **alpha release**. Nevertheless you are able to create a basic plugin with this boilerplate. We believe that this is an excellent approach to wp-plugin-development and hope for contributions! 
> 
> As we will be creating more plugins for our customers in the future, we will extend and add new modules every now and then. We will try to actively promote the development of this plugin.

## Getting Started

    yo naymspace-wp-plugin

## Why should i use this?
This opinionated plugin-boilerplate was written for developers (ourselves). Therefore it's built to be easily understandable, maintainable and extendable. After the generator has done it's work, the plugin will be recognized by wordpress' plugin manager and you can start developing.

## Yeoman did all his fancy magic, what now?

Now you will have to get your hands dirty and alter the index.php and the modules you want to use. 

#### index.php

This is where your plugin's **options** go, that you want to be configured via the Backend. Add them to your plugin's Base::options hash like so: 
    
    'someOption' => array(
        'id'    => '<%namespace%>-someOption',
        'title' => 'Some description for the admins',
        'type'  => '[checkbox|text]'
    ),
    
The "<%namespace%>" will be replaced by the generator, depending on the namespace and plugin name you provided. This is solely to prevent namespace-clashes, when using options in your plugin the hash-key ('someOption') acts as an id. 

Please have a look at [wordpress' codex](https://codex.wordpress.org/Writing_a_Plugin#File_Headers), which explains what metadata will be shown by wordpress' plugin manager.

Aside from that you only have to care about what modules are loaded when in the constructor. By default no modules are loaded.

## Modules
We aim to separate most features into modules. This way no unneccessary code has to be loaded, if it is not needed.
For now there are just 3 modules:

#### Helper
Some static methods to make your life a little easier.

#### Frontend
Loads scripts/main.js and stylesheets/main.css by default. Have a look into the module. 

#### Backend
Creates an options page in the backend, which renders all the options you specified in the plugin's index.php. 

#### Database
This is just a stub. Please contribute!

## TODO
* Retrieve options via Helper.
* Default values for options. 
* Add AJAX-module
* Add more functionality to database-module
* use plugin-name for options-page
 

## License

[MIT](http://opensource.org/licenses/MIT)
