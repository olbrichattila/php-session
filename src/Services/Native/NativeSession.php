<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Services\Native;

use Aolbrich\PhpSession\Interfaces\SessionInterface;

class NativeSession implements SessionInterface
{
    public function start(): string
    {
        session_start();
        return session_id();
    }

    public function destroy(): void
    {
        // @TODO with TDD
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function getAll(): array
    {
        return $_SESSION ?? [];
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function delete(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}
