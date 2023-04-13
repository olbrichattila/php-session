<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test\Services\File;

use Aolbrich\PhpSession\Services\File\FileStorage;
use PHPUnit\Framework\TestCase;

class FileStorageTest extends TestCase
{
    public function testClassLoads(): void
    {
        $storage = new FileStorage();
        
        $this->assertEquals('object', gettype($storage));
    }

    public function testSetAndGet(): void
    {
        $storage = new FileStorage();
        $storage->setSessionName('test_name');
        $storage->set('key1', 'Data1');
        $storage->set('key2', 'Data2');

        $this->assertEquals('Data1', $storage->get('key1'));
        $this->assertEquals('Data2', $storage->get('key2'));

        $storage->delete('key1');
        $this->assertEquals(null, $storage->get('key1'));
        $this->assertEquals('Data2', $storage->get('key2'));

        $storage->delete('key2');
        $this->assertEquals(null, $storage->get('key2'));
    }
}
