<?php
/**
 * FabulousFormMaker.php
 * this file is the starting point for all other files in this plugin
 * this file acts as the controller 
 */

//use an auto loader to load all PHP classes
spl_autoload_extensions( ".php" ); // comma-separated list
spl_autoload_register();

//set up some constants for our plugin
define( "DS", DIRECTORY_SEPARATOR );
define( "PLUGIN_PATH", __DIR__ . DS );
define( "PLUGIN_FILE", __FILE__ );
define( "DB_VERSION", 1.0 );

//load our config file
$config = json_decode( file_get_contents( PLUGIN_PATH . "config.json" ) );

//add another constant for our namespace
$namespace = "\FM\\" . $config->adapter;
define( "NAMESPACE_PATH", PLUGIN_PATH . $namespace . DS );

//create our adapter
$a = NAMESPACE_PATH . "adapter";
$adapter = new $a;

//load any support files
$supportFile =  NAMESPACE_PATH . "support.php";
if( file_exists( $supportFile ) )
	require_once $supportFile;