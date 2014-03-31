<?php
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

class Frontend{

  function __construct(){
    add_action( 'wp_enqueue_scripts', array($this, 'register_assets'));
    // if Helper::get_option('someCheckboxOption'){
    //  add_action('wp_footer', function(){ Helper::render_template('myTemplate'); }); // render some template in the footer
    // }
  }

  // load your scripts and styles
  function register_assets() {
    $this->add_script('main'); // adds scripts/main.js
    $this->add_style( 'main'); // adds stylesheets/main.css
  }

  private function add_style($name) {
    wp_register_style( __NAMESPACE__."-style-{$name}", plugins_url( "/../stylesheets/{$name}.css", __FILE__ )) ;
    wp_enqueue_style(  __NAMESPACE__."-style-{$name}" );
  }

  private function add_script($name, $dependencies = array(), $version="1.0", $include_in_footer = true){
    wp_register_script( __NAMESPACE__."-script-{$name}", plugins_url( "/../scripts/{$name}.js", __FILE__ ), $dependencies, $version, $include_in_footer);
    wp_enqueue_script(  __NAMESPACE__."-script-{$name}" );
  }

}

?>
