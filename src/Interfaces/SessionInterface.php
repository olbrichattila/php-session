<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Interfaces;

interface SessionInterface
{
    public function start(): string;
    public function destroy(): void;
    public function get(string $key): mixed;
    public function getAll(): array;
    public function set(string $key, mixed $value);
    public function delete(string $key): void;
}
