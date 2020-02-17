<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Newsletter\DAO\NewsLetterDAO;
use Newsletter\Controllers\SignupController;
use Slim\App as SlimApp;
use Slim\Views\PhpRenderer;

require '../../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['db']['host'] = '173.199.114.246';
$config['db']['user'] = 'root';
$config['db']['pass'] = 'Titans1!';
$config['db']['dbname'] = 'newsletter';
$app = new SlimApp(['settings' => $config]);

$container = $app->getContainer();
$container['view'] = new PhpRenderer('templates');

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $host = $db['host'];
    $dbname = $db['dbname'];
    $string = "mysql:host=$host;dbname=$dbname";

    $pdo = new PDO($string, $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$app->get('/signup', function ($request, $response) {
    return $this->view->render($response, 'signup.phtml', []);
});

$app->get('/subscribers_view', function($request, $response) {
    $dao = new NewsLetterDAO($this->db);
    $data = $request->getParsedBody();
    
    $controller = new SignupController($dao);
    $subscribers = $controller->getSubscribers();

    return $this->view->render($response, 'subscribers_view.phtml', ['subscribers' => $subscribers]);
});

$app->post('/signup/submit', function ($request, $response) {
    $dao = new NewsLetterDAO($this->db);
    $data = $request->getParsedBody();
	
    $controller = new SignupController($dao);
    $controller->signupUser($data['name'], $data['email']);

	return $response->withJson(['success' => true], 200);
});

$app->run();
