<?php declare(strict_types=1);


class User
{
    private string $username;

    private string $pin;

    public function __construct(string $username, string $pin)
    {

        $this->username = $username;
        $this->pin = $pin;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPin(): string
    {
        return $this->pin;
    }
}
