<?php declare(strict_types=1);

require_once 'app/Session.php';
require_once 'app/DataStorage.php';
require_once 'app/User.php';

session_start();
$session = new Session();
$pin = $session->enterPin();

$start = (strlen($pin) == 0 || strlen($pin) == 4)
    ? 'Enter PIN'
    : str_repeat('*', strlen($pin));

$userData = new DataStorage('data.csv');
if ($userData->getByPin($pin)) {
    $user = $userData->getByPin($pin);
    $session->signIn(
        $user->getId(),
        $user->username()
    );
}

$chat = new DataStorage('chat.csv');
if (isset($_POST['message'])) {
    $chat->addToStorage([
        $_SESSION['id'],
        $_POST['message']
    ]);
}

if (isset($_POST['signOut'])) {
    $session->signOut();
}

?>

<html>
<head>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<?php if (!isset($_SESSION['id'])) : ?>
    <h2><?= $start; ?></h2>
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
<?php endif; ?>

<?php if (isset($_SESSION['id'])) : ?>
    <h4>Hello <?= $_SESSION['name'] ?? 'stranger'; ?></h4>
    <form action="/" method="post">
        <label for="message">Write a message</label>
        <input type="text" name="message" id="message"/>
        <button type="submit">Submit</button>
    </form>
    <form method="post" action="/">
        <input type="hidden" name="signOut" id="signOut">
        <button type="submit">Sign out</button>
    </form>
<?php endif; ?>
</body>
</html>
