<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession;

use Aolbrich\PhpDiContainer\Container;
use Aolbrich\PhpSession\Interfaces\SessionInterface;

class Session implements SessionInterface
{
    protected SessionInterface $sessionService;

    public function __construct(SessionInterface $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function start(): string
    {
        return $this->sessionService->start();
    }

    public function destroy(): void
    {
        $this->sessionService->destroy();
    }

    public function get(string $key): mixed
    {
        return $this->sessionService->get($key);
    }

    public function getAll(): array
    {
        return $this->sessionService->getAll();
    }

    public function set(string $key, mixed $value): void
    {
        $this->sessionService->set($key, $value);
    }

    public function delete(string $key): void
    {
        $this->sessionService->delete($key);
    }
}
