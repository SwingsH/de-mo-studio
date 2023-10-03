<?php
// ** Path Setting ** //
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/DE-MO//') ;
define('INCLUDE_PATH', ROOT_PATH . 'includes/' ) ;
define('AMFSERVICE_PATH', INCLUDE_PATH . 'amfphp/services/' ) ;
define('TEMPLATE_PATH' , ROOT_PATH . 'template/');

// ** MySQL settings ** //
// define('DB_NAME', 'demo');    // The name of the database
// define('DB_USER', 'demoteam');     // Your MySQL username
// define('DB_PASSWORD', 'demostudio'); // ...and password
// define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value
define('DB_NAME', 'demo');    // The name of the database
define('DB_USER', 'tizsoft');     // Your MySQL username
define('DB_PASSWORD', '16888'); // ...and password
define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value

// ** SystemL settings ** //
//define('IPDOMAIN','http://192.83.193.117/');
define('IPDOMAIN','http://127.0.0.1/DE-MO/');
?>