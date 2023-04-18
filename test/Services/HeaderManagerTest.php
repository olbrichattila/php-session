<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test\Services;

use Aolbrich\PhpDiContainer\Container;
use Aolbrich\PhpSession\Services\HeaderManager;
use PHPUnit\Framework\TestCase;

class HeaderManagerTest extends TestCase
{
    public function testHeaderManagerLoads(): void
    {
        $headerManager = new HeaderManager();

        $this->assertEquals('object', gettype($headerManager));
    }

    public function testHeaderManagerSetsId(): void
    {
        $headerManager = new HeaderManager();
        $sessionId = $headerManager->sessionId();
        
        $this->assertGreaterThan(12, strlen($sessionId));
    }

    public function testHeaderManagerDestroys(): void
    {
        $headerManager = new HeaderManager();
        $cookieName = $headerManager->cookieName();
        
        $_COOKIE[$cookieName] = "test_value";

        $this->assertTrue(isset($_COOKIE[$cookieName]));

        $headerManager->destroy();

        $this->assertFalse(isset($_COOKIE[$cookieName]));
    }
}
