<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test\Services\Native;

use Aolbrich\PhpSession\Services\Native\NativeSession;
use PHPUnit\Framework\TestCase;

class NativeSessionTest extends TestCase
{
    public function setUp(): void
    {
        $_SESSION = [];
    }

    public function testClassLoads(): void
    {
        $session = new NativeSession();
        
        $this->assertEquals('object', gettype($session));
    }

    public function testClassCreatesNewSession(): void
    {
        $session = new NativeSession();
        $sessionId = $session->start();
        
        $this->assertGreaterThan(7, strlen($sessionId));
    }

    public function testGetSessionByKey(): void
    {
        $key = 'test';
        $value = 'Session variable';
        $_SESSION[$key] = $value;
        $session = new NativeSession();
        $result = $session->get($key);
        
        $this->assertEquals($value, $result);
    }

    public function testGetSessions(): void
    {
        $key = 'test';
        $value = 'Session variable';
        $key2 = 'test2';
        $value2 = 'Session variable 2';
        $_SESSION[$key] = $value;
        $_SESSION[$key2] = $value2;
        $session = new NativeSession();
        $result = $session->getAll();

        $this->assertCount(2, $result);
        $keys = array_keys($result);
        $values = array_values($result);

        $this->assertEquals($key, $keys[0]);
        $this->assertEquals($value, $values[0]);

        $this->assertEquals($key2, $keys[1]);
        $this->assertEquals($value2, $values[1]);
    }
    

    public function testSetSession(): void
    {
        $key = 'test';
        $value = 'Session variable';
        
        $session = new NativeSession();
        $session->set($key, $value);
        $result = $session->get($key);
        
        $this->assertEquals($value, $result);
    }

    public function testDeleteSession(): void
    {
        $key = 'test';
        
        $session = new NativeSession();
        $session->set($key, 'test value');
        $session->delete($key);
        $result = $session->get($key);

        $this->assertNull($result);
    }
}
