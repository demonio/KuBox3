<?php
error_reporting( E_ALL ^ E_STRICT );
ini_set( 'display_errors', 1 ); 
define( 'START_TIME', microtime( 1 ) );
define( 'APP_PATH', '/Applications/XAMPP/xamppfiles/htdocs/kubox3/app/' );
define( 'CORE_PATH', '/Applications/XAMPP/xamppfiles/htdocs/kumbiaphp/cores/120318/' );
define( 'PUBLIC_PATH', '/' );
define( 'PUB_PATH', '/Applications/XAMPP/xamppfiles/htdocs/kubox3/pub/' );
define( 'URL_PATH', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
$url = isset($_GET['_url']) ? $_GET['_url'] : '/';
//require APP_PATH . 'libs/bootstrap.php'; //bootstrap de app
require CORE_PATH . 'kumbia/bootstrap.php'; //bootstrap del core 
