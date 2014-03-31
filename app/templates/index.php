<?php
/*
Plugin Name: <%= namespace %>
Version: 0.0.1
*/

/*
 * ******************************************************************
 * Copyright (c) 2014 Pierre Beitz <pb@naymspace.de>, naymspace
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * ******************************************************************
 */

namespace <%= namespace %>;

class Base {

  // options to be set in the admin-area
  public static $options = array(
    <% if (includeBackend){ %>
    'someTextOption' => array(
      'id'    => '<%= namespace %>-someTextOption',
      'title' => 'Some description',
      'type'  => 'text'
    ),
    'someCheckboxOption' => array(
      'id'    => '<%= namespace %>-someCheckboxOption',
      'title' => 'Some description',
      'type'  => 'checkbox'
    ),
    <% } %>
  );

  function __construct() {

    spl_autoload_register( array($this, 'plugin_autoloader') );
    <% if (includeBackend){ %>
    if ( Helper::in_backend() ){
      new Backend();
    }
    <% } if (includeFrontend){ %>
    if ( !Helper::in_backend() ){
      new Frontend();
    }
    <% } if (includeDatabase){%>
    new Database();
    <% } %>
  }

  function plugin_autoloader ( $class ) {
    $dir = dirname(__FILE__);
    $namespace = explode('\\', $class);
    $className = $namespace[ count($namespace)-1 ]; // this feels very hacky. any suggestions?

    if ( file_exists ("{$dir}/modules/{$className}.php" ) ){
      require_once "{$dir}/modules/{$className}.php";
    }
  }
}

new Base();
