<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test;

use Aolbrich\PhpSession\Interfaces\SessionInterface;
use Aolbrich\PhpSession\Session;
use PHPUnit\Framework\TestCase;

class SessionStartTest extends TestCase
{
    private SessionInterface $mock;

    public function setUp(): void
    {
        $this->mock = $this->getMockForAbstractClass(SessionInterface::class);
    }

    public function testSessionStarts(): void
    {
        $this->mock->expects($this->once())
            ->method('start')
            ->willReturn('12345678');

        $session = new Session($this->mock);
        $sessionId = $session->start();
        
        $this->assertGreaterThan(7, $sessionId);
    }

    public function testDestroy(): void
    {
        $this->mock->expects($this->once())
            ->method('destroy');

        $session = new Session($this->mock);
        $session->destroy();
    }

    public function testGet(): void
    {
        $this->mock->expects($this->once())
            ->method('get')
            ->with('key')
            ->willReturn('return value');

        $session = new Session($this->mock);
        $value = $session->get('key');

        $this->assertEquals('return value', $value);
    }

    public function testGetAll(): void
    {
        $this->mock->expects($this->once())
            ->method('getAll')
            ->willReturn([1,2]);

        $session = new Session($this->mock);
        $result = $session->getAll();

        $this->assertEquals([1,2], $result);
    }

    public function testSet(): void
    {
        $this->mock->expects($this->once())
            ->method('set')
            ->with('key', 'value');

        $session = new Session($this->mock);
        $session->set('key', 'value');
    }

    public function testDelete(): void
    {
        $this->mock->expects($this->once())
            ->method('delete')
            ->with('key');

        $session = new Session($this->mock);
        $session->delete('key');
    }
}
