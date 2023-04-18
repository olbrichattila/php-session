<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Services;
use SebastianBergmann\Type\VoidType;

class HeaderManager
{
    // @todo get this form config
    protected string $cookieName = 'TEST-COOKIE';

    // @todo get this from config
    protected string $sessionPrefix = "test_sessid_";

    // @todo get this from config, 86400 = 1 day, allow null as browser session only cookie via setting it to null
    protected int $ttl = 0; 

    public function sessionId(): string
    {
        $sessionId = $this->headerSessionId();
        if ($sessionId) {
            return $sessionId;
        }

        return $this->setHeaderSessionId($this->generateSessionId());
    }

    public function destroy(): void
    {
        if(isset($_COOKIE[$this->cookieName])) {
            unset($_COOKIE[$this->cookieName]);
            setcookie($this->cookieName, '', time() - 3600, '/');
        }
    }

    public function cookieName(): string
    {
        return $this->cookieName;
    }

    protected function headerSessionId(): ?string
    {
        if(isset($_COOKIE[$this->cookieName])) {
            return $_COOKIE[$this->cookieName];
        }

        return null;
    }

    protected function setHeaderSessionId(string $sessionId): string
    {
        setcookie($this->cookieName, $sessionId, $this->ttl, "/"); 

        return $sessionId;
    }

    protected function generateSessionId(): string
    {
        return $this->sessionPrefix . microtime(true) . $this->generateRandomString();
    }

    protected function generateRandomString($length = 10) {

        return substr(
            str_shuffle(
                str_repeat(
                    '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    (int)ceil($length/62) 
                )
            ),
            1,
            $length
        );
    }
}
