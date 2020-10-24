<?php declare(strict_types=1);

class Person
{
    private string $name;

    private string $surname;

    private string $number;

    public function __construct(string $name, string $surname, string $number)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->number = $number;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
