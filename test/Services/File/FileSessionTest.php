<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test\Services\File;

use Aolbrich\PhpDiContainer\Container;
use Aolbrich\PhpSession\Services\File\FileSession;
use PHPUnit\Framework\TestCase;

class FileSessionTest extends TestCase
{
    public function testClassLoads(): void
    {
        $session = (new Container())->get(FileSession::class);
        
        $this->assertEquals('object', gettype($session));
    }

    public function testSetAndGet(): void
    {
        $session = (new Container())->get(FileSession::class);
        $session->setSessionName('test_name');
        $session->set('key1', 'Data1');
        $session->set('key2', 'Data2');

        $this->assertEquals('Data1', $session->get('key1'));
        $this->assertEquals('Data2', $session->get('key2'));

        $session->delete('key1');
        $this->assertEquals(null, $session->get('key1'));
        $this->assertEquals('Data2', $session->get('key2'));

        $session->delete('key2');
        $this->assertEquals(null, $session->get('key2'));
    }
}
