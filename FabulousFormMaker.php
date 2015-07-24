<?php
/*
 Plugin Name: Fabulous Form Maker
 Plugin URI: http://wordpress.org/plugins/fabulous-form-maker
 Description: A custom form maker that allows users to build their own forms easily and without any knowledge of coding or progamming. Users can create text boxes, passwords fields, drop down select boxes, radio boxes, checkboxes, and text areas.
 Version: 2.0.0
 Author: Ellytronic Media
 Author URI: http://ellytronic.com
 License:GPL2
 Copyright 2013  Ellytronic Media  (email : elly@ellytronic.media)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA




 FabulousFormMaker.php
 this file is the starting point for all other files in this plugin
 this file acts as the controller 
 */


//set up some constants for our plugin
define( "DS", DIRECTORY_SEPARATOR );
define( "FM_PLUGIN_PATH", __DIR__ . DIRECTORY_SEPARATOR );
define( "FM_PLUGIN_FILE", __FILE__ );
define( "FM_DB_VERSION", 1.0 );


//use an auto loader to load all PHP classes
spl_autoload_register( function( $class ) {
    //mask the \\
    $class = ltrim( $class, '\\' );
    //if not FM namespace or sub-namespace of FM, return
    if( strpos( $class, "FM" ) !== 0)
        return;

    //load the class
    $path =  FM_PLUGIN_PATH . str_replace( '\\', DS, $class ) . '.php';
    require_once $path;
} );

//load our config file
$config = json_decode( file_get_contents( FM_PLUGIN_PATH . "config.json" ) );

//add another constant for our namespace
$namespace = "FM\\" . $config->adapter;

define( "FM_NAMESPACE_PATH", $namespace . "\\" );
define( "FM_NAMESPACE_FILE_PATH", FM_PLUGIN_PATH . "FM" . DS . $config->adapter . DS );

//create our adapter
$a = FM_NAMESPACE_PATH . "Adapter";
$adapter = new $a;

//load any support files
$supportFile = FM_NAMESPACE_FILE_PATH . "support.php";
if( file_exists( $supportFile ) )
	require_once $supportFile;



//test functions
/*$f = new FM\Field(1);
echo $f->getAdminHtml();
FM\Editor::getEditor();*/