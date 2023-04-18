<?php

declare(strict_types=1);

// use Aolbrich\PhpSession\Services\Native\NativeSession;
use Aolbrich\PhpSession\Services\File\FileSession;
use Aolbrich\PhpSession\Interfaces\SessionInterface;
use Aolbrich\PhpDiContainer\Container;
use Aolbrich\PhpSession\Session;

require_once realpath(__DIR__ . '/../../vendor') . '/autoload.php';

// Bind here which servie provider you would like to use, like native, file, redis, mongodb....
$bindings = [
    // SessionInterface::class => NativeSession::class
    SessionInterface::class => FileSession::class
];
$container = new Container($bindings);
$session = $container->get(Session::class);

// Start session
$session->start();

// // set keys
$session->set('sessionKey1', 'Value1');
$session->set('sessionKey2', 'Value2');

// display the results
echo $session->get('sessionKey1');
print_r($session->getAll());

// $session->destroy();
