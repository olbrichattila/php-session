<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test;

use Aolbrich\PhpSession\Interfaces\SessionInterface;
use Aolbrich\PhpSession\Session;
use PHPUnit\Framework\TestCase;

class SessionStartTest extends TestCase
{
    public function testSessionStarts(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);
        $mock->expects($this->once())
            ->method('start')
            ->willReturn('12345678');

        $session = new Session($mock);
        $sessionId = $session->start();
        
        $this->assertGreaterThan(7, $sessionId);
    }

    public function testDestroy(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);
        $mock->expects($this->once())
            ->method('destroy');

        $session = new Session($mock);
        $session->destroy();
    }
    public function testGet(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);
        $mock->expects($this->once())
            ->method('get')
            ->with('key')
            ->willReturn('return value');

        $session = new Session($mock);
        $value = $session->get('key');

        $this->assertEquals('return value', $value);
    }

    public function testGetAll(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);
        $mock->expects($this->once())
            ->method('getAll')
            ->willReturn([1,2]);

        $session = new Session($mock);
        $result = $session->getAll();

        $this->assertEquals([1,2], $result);
    }

    public function testSet(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);
        $mock->expects($this->once())
            ->method('set')
            ->with('key', 'value');

        $session = new Session($mock);
        $session->set('key', 'value');
    }

    public function testDelete(): void
    {
        $mock = $this->getMockForAbstractClass(SessionInterface::class);
        $mock->expects($this->once())
            ->method('delete')
            ->with('key');

        $session = new Session($mock);
        $session->delete('key');
    }
}
