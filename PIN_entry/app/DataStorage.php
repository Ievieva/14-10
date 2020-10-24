<?php declare(strict_types=1);


class DataStorage
{
    private $resource;
    private array $users;

    public function __construct()
    {
        $this->resource = fopen('./data.csv', 'rw+');
        $this->loadUsers();
    }

    private function loadUsers(): void
    {
        while (!feof($this->resource)) {
            $userData = (array)fgetcsv($this->resource);

            $this->users[] = new User(
                (string)$userData[0],
                (string)$userData[1]
            );
        }
    }

    public function getByPin(string $pin): ?User
    {
        foreach ($this->users as $user) {
            /** @var User $user */
            if ($pin == $user->getPin()) {
                return $user;
            }
        }
        return null;
    }
}
