<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Test\Services\File;

use Aolbrich\PhpSession\Services\File\FileSession;
use PHPUnit\Framework\TestCase;

class FileSessionTest extends TestCase
{
    public function testClassLoads(): void
    {
        $session = new FileSession();
        
        $this->assertEquals('object', gettype($session));
    }
}
