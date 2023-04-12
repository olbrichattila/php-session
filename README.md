# PHP Session Wrapper
This library wraps the session management into a class, it is possible to utilize different ways of storing the session (other then PHP standard) via implementing a new class from SessionInterface, or use one of the existing class
## !!! This is a work in progress !!!

Features:

- Native PHP session wrapper
- File Session wrapper (@TODO)
- Redis PHP session wrapper (@TODO)
- Memcache PHP session wrapper (use with caution, memcahce can evict keys if memory usage requires it) (@TODO)
- Database (MySql, Postgres, SQLIte) (@TODO)
- Database (Mongo DB) (@TODO)

Example usage:

```
<?php

declare(strict_types=1);

use Aolbrich\PhpSession\Services\Native\NativeSession;
use Aolbrich\PhpSession\Interfaces\SessionInterface;
use Aolbrich\PhpDiContainer\Container;
use Aolbrich\PhpSession\Session;

// Bind here which servie provider you would like to use, like native, file, redis, mongodb....
$bindings = [
    SessionInterface::class => NativeSession::class
];
$container = new Container($bindings);
$session = $container->get(Session::class);

// Start session
$session->start();

// set keys
$session->set('sessionKey1', 'Value1');
$session->set('sessionKey2', 'Value2');

// display the results
echo $session->get('sessionKey1');
print_r($session->getAll());
```

