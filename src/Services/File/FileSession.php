<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Services\File;

use Aolbrich\PhpSession\Interfaces\SessionInterface;
use Aolbrich\PhpSession\Services\HeaderManager;

class FileSession implements SessionInterface
{
    protected string $sessionName;

    public function __construct(protected readonly HeaderManager $headerManager)
    {
        $this->sessionName = $headerManager->sessionId();
    }

    public function start(): string
    {
        return $this->headerManager->sessionId();
    }

    public function destroy(): void
    {
        $sessionFileName = $this->getFileName();
        if (file_exists($sessionFileName)) {
            unlink($sessionFileName);
        }

        $this->headerManager->destroy();
    }

    public function get(string $key): mixed
    {
        $sessionData = $this->getSessionData();

        return $sessionData[$key] ?? null;
    }

    public function getAll(): array
    {
        return $this->getSessionData();
    }

    public function set(string $key, mixed $value): void
    {
        $sessionData = $this->getSessionData();
        $sessionData[$key] = $value;

        $this->setSessionData($sessionData);
    }

    public function delete(string $key): void
    {
        $sessionData = $this->getSessionData();
        if (isset($sessionData[$key])) {
            unset($sessionData[$key]);
        }

        $this->setSessionData($sessionData);
    }

    protected function getSessionData(): array
    {
        $sessionFileName = $this->getFileName();
        if (file_exists($sessionFileName)) {
            $content = unserialize(file_get_contents($sessionFileName));

            if (!is_array($content)) {
                // @TODO create proper exception classes
                throw new \Exception('Incorrect session data');
            }

            return $content;
        }

        return [];
    }
    protected function setSessionData(array $data): void
    {
        $sessionFileName = $this->getFileName();
        file_put_contents($sessionFileName, serialize($data));
    }

    protected function getFileName(): string
    {
        // @TODO change it to dediceted file path form config, when config implemented
        // return $this->sessionName;
        return realpath('../../sessions/' ). '/' . $this->sessionName;
        // return sys_get_temp_dir() . '/' . $this->sessionName;
    }
}
