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


/**
 * THIS IS WORK IN PROGRESS, AND NOT TESTED IN ANY WAY! FEEL FREE TO CONTRIBUTE
 */
namespace <%= namespace %>;

/*
 * ### SETUP ###
 * adjust tableName to your needs
 * adjust the db-Schema in init_table()
 *
 * ### ATTENTION ###
 * if you ever change the schema after setup, bump "version"
 */
class Database {

  const tableName = 'myTableName';
  const version = "1.0.0";

  function __construct(){
    $this->init_table();
  }

  private function init_table() {
    global $wpdb;

    $versionOption = Database::tableName . "_db_version";
    $currentVersion = get_option( $versionOption );

    if( $currentVersion != Database::version ) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $table = $wpdb->prefix . $tableName;
      $sql = "CREATE TABLE $table (
        id INTEGER NOT NULL AUTO_INCREMENT,
        created_at DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
        someString VARCHAR(64) NOT NULL,
        someBoolean TINYINT(1) DEFAULT '0' NOT NULL,
        someInt INTEGER,
        UNIQUE KEY id (id)
        );";
      dbDelta($sql);
      update_option( $versionOption, Datanase::version );

    }
  }
}
