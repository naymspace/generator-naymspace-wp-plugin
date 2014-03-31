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

class Backend {

  function __construct() {
    add_action( 'admin_menu', array( $this, 'plugin_menu' ) );
  }

  // displays plugins menu in wordpress' toolbar, TODO: alter the second string, if you want a more readable name in the backend
  function plugin_menu() {
    add_options_page( '<%= namespace %>', '<%= namespace %>', 'manage_options', '<%= namespace %>-options', function () {

      if ( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'Sie besitzen nicht die Rechte zum Bearbeiten.' ) );
      }

      // handle posted options
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->handle_options();
      }

      // display plugin's options page
      Helper::render_template('admin/options');

    });
  }


  // handle posted option-values
  function handle_options() {
    foreach ( Base::$options as $option ) {
      $id = $option['id'];
      $new_value = $_POST[ $id ];
      switch ( $option['type'] ) {
      case 'text':
        if ( isset( $new_value ) )
          update_option( $id, $new_value );
        break;

      case 'checkbox':
        update_option( $id, isset( $new_value ) );
        break;
      }
    }
  }


  public static function render_option( $option ) {
    switch ( $option['type'] ) {
    case 'text':
      Helper::render_template('admin/helpers/form_label', $option);
      Helper::render_template('admin/helpers/form_text', $option);
      break;

    case 'checkbox':
      Helper::render_template('admin/helpers/form_label', $option);
      Helper::render_template('admin/helpers/form_checkbox', $option);
      break;
    }
  }

}
