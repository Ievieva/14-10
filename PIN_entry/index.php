<?php declare(strict_types=1);

require_once 'app/Session.php';
require_once 'app/DataStorage.php';
require_once 'app/User.php';

session_start();
$session = new Session();
$pin = $session->enterPin();

$storage = new DataStorage();
if ($storage->getByPin($pin)) {
    $user = $storage->getByPin($pin);
    $username = $user->getUsername();
    $session->signIn($username);
}

if (!$_SESSION['username'] && strlen($pin) == 0) {
    $greeting = 'Enter PIN';
} elseif (strlen($pin) < 4) {
    $greeting = str_repeat('*', strlen($pin));
} else {
    $greeting = 'Hello ' . ($username ?? 'stranger, enter PIN');
}
?>

<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h3><?= $greeting; ?></h3>
<div class="centered">
    <form action="/" method="post">
        <?php for ($i = 1; $i < 10; $i++) { ?>
            <button type="submit" name="pin" value="<?= $i; ?>"><?= $i; ?></button>
        <?php } ?>
    </form>
    <form action="/" method="post">
        <button type="submit" name="pin" value="0">0</button>
    </form>
</div>
</body>
</html>
