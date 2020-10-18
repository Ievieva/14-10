<?php declare(strict_types=1);


class User
{
    private int $id;
    private string $username;

    public function __construct(int $id, string $username)
    {
        $this->username = $username;
        $this->id = $id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
