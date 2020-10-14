<?php declare(strict_types=1);

class DataStorage
{
    private $resource;
    private array $persons;

    public function __construct()
    {
        $this->resource = fopen('./file.csv', 'rw+');
        $this->loadPersons();
    }

    private function loadPersons(): void
    {
        while (!feof($this->resource)) {
            $personData = (array)fgetcsv($this->resource);

            $this->persons[] = new Person(
                (string)$personData[0],
                (string)$personData[1],
                (string)$personData[2]
            );
        }
    }

    public function getByNumber(string $number): ?Person
    {
        foreach ($this->persons as $person) {
            /** @var Person $person */
            if ($number == $person->getNumber()) {
                return $person;
            }
        }
        return null;
    }
}
