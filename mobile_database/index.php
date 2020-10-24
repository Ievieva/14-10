<?php

require_once 'Person.php';
require_once 'DataStorage.php';

$dataStorage = new DataStorage();
$number = $_POST['number'] ?? '000';
if ($dataStorage->getByNumber($number)) {
    $person = $dataStorage->getByNumber($number);
    $result = $person->getName() . ' ' . $person->getSurname();
} else {
    $result = 'Telefona numurs netika atrasts.';
}

?>

<html>
<body>
<form method="post" action="/">
    <label for="number">Telefona numurs: </label>
    <input type="text" name="number" id="number"/>
    <button type="submit">Submit</button>
</form>
<h3><?= $result; ?></h3>
</body>
</html>
