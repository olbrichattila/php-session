<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Services\File;

class FileStorage
{
    protected string $sessionName;

    public function setSessionName(string $sessionName): void
    {
        $this->sessionName = $sessionName;
    }

    public function set(string $key, mixed $value): void
    {
        $sessionData = $this->getSessionData();
        $sessionData[$key] = $value;

        $this->setSessionData($sessionData);
    }

    public function get(string $key): mixed
    {
        $sessionData = $this->getSessionData();
        
        return $sessionData[$key] ?? null;
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
        return sys_get_temp_dir() . '/' . $this->sessionName;
    }
}