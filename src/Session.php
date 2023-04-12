<?php
// @TODO add expiration

declare(strict_types=1);

namespace Aolbrich\PhpSession;

use Aolbrich\PhpSession\Interfaces\SessionInterface;

class Session implements SessionInterface
{
    public function __construct(protected readonly SessionInterface $sessionService)
    {
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
