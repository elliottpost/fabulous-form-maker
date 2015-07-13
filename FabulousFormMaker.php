<?php
/**
 * FabulousFormMaker.php
 * this file is the starting point for all other files in this plugin
 */

//use an auto loader to load all PHP classes
spl_autoload_extensions( ".php" ); // comma-separated list
spl_autoload_register();

//load our config file
$config = json_decode( file_get_contents( __DIR__ . "\config.json" ) );

//create our adapter
$a = "\FM\\" . $config->adapter . "\\adapter";
$adapter = new $a;