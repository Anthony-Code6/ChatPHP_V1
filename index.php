<?php
require __DIR__ . '/vendor/autoload.php';
$router = new \Bramus\Router\Router();

require 'rb.php';
R::setup( 'mysql:host=localhost;dbname=chat_app_php', 'root', '123456789' );
//R::setup( 'mysql:host=localhost;dbname=id21994108_chat', 'id21994108_root', 'DarkRevan@2' );

require './services/EncryptionAppService/Encryptar.php';
require './services/OpenSSLAppService/OpenSSL.php';

// Configuracion
require './controller/BaseController.php';

// Controlador del Registro y Login
require './controller/HomeController.php';

// Controlador Chat
require './controller/ChatController.php';

$router->run();
?>