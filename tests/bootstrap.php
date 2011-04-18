<?php 

$paths = array(
  __DIR__ .'/../lib/vendor',
  __DIR__ .'/../lib/',
);
set_include_path(implode(PATH_SEPARATOR,$paths));

// Setup Zend's autoloader
require_once __DIR__ . '/../lib/vendor/Zend/Loader/Autoloader.php';

// Zend Loader really sucks. Why can't registerNamespace accept a second 
// parameter for specifying the root folder to look at for the prefix?
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace('Boz_');