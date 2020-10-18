<?php declare(strict_types=1);


class DataStorage
{
    private $resource;
    private array $data;

    public function __construct(string $path)
    {
        $this->resource = fopen($path, 'rw+');
        $this->loadData();
    }

    private function loadData(): void
    {
        while (!feof($this->resource)) {
            $this->data[] = (array)fgetcsv($this->resource);
        }
    }

    public function addToStorage(array $data): void
    {
        if ($data) {
            fputcsv($this->resource, $data);
        }
    }

    public function getByPin(string $pin): ?User
    {
        foreach ($this->data as $userData) {
            if ($userData[2] == $pin) {
                return new User(
                    (int)$userData[0],
                    (string)$userData[1]
                );
            }
        }
        return null;
    }
}
