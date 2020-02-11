<?php
//Start session
session_start();

//Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/ocorrencias.php');
require('controllers/piquetes.php');
require('controllers/novidades.php');
require('controllers/users.php');

require('models/home.php');
require('models/ocorrencia.php');
require('models/piquete.php');
require('models/novidade.php');
require('models/user.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();

if($controller){
  $controller->executeAction();
}
