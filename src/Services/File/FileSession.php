<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Services\File;

use Aolbrich\PhpSession\Interfaces\SessionInterface;

class FileSession implements SessionInterface
{
    public function start(): string
    {
        return "";
    }

    public function destroy(): void
    {
    }

    public function get(string $key): mixed
    {
        return null;
    }

    public function getAll(): array
    {
        return [];
    }

    public function set(string $key, mixed $value): void
    {
    }

    public function delete(string $key): void
    {
    }
}
