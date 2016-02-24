<?php
require('vendor/autoload.php');
require('vendor/3rdparty/idiorm.php');
require('vendor/3rdparty/paris.php');

ORM::configure('mysql:host=localhost;dbname=siili');
ORM::configure('username', 'root');
ORM::configure('password', '');
ORM::configure('return_result_sets', true);

require_once('models.php');

$app = new \Slim\Slim();

// Database
$app->container->singleton('db',function(){
	return new PDO('mysql:host=localhost;dbname=siili;','root','');
});

 require('routes.php');

$app->run();
?>