<?php

declare(strict_types=1);

namespace Aolbrich\PhpSession\Services;

class HeaderManager
{
    // @todo get this form config
    protected string $cookieName = 'TEST-COOKIE';

    // @todo get this from config
    protected string $sessionPrefix = "test_sessid_";

    public function sessionId(): string
    {
        $sessionId = $this->headerSessionId();
        if ($sessionId) {
            return $sessionId;
        }

        return $this->setHeaderSessionId($this->generateSessionId());
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
        $time = time() + (86400 * 30); // 86400 = 1 day, @todo get this from config, allow cookie only valid for browser session
        setcookie($this->cookieName, $sessionId, time() + (86400 * 30), "/"); 

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
