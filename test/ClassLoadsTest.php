<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test;

use Aolbrich\PhpSession\Interfaces\SessionInterface;
use Aolbrich\PhpSession\Session;
use PHPUnit\Framework\TestCase;

class ClassLoadsTest extends TestCase
{
    public function testClassLoads(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);

        $session = new Session($mock);
        
        $this->assertEquals('object', gettype($session));
    }
}
