<?php declare(strict_types=1);

class Session
{
    public function enterPin(): string
    {
        if (isset($_POST['pin'])) {
            $_SESSION['pin'] .= $_POST['pin'];
        }

        $pin = $_SESSION['pin'] ?? '';

        if (strlen($pin) >= 4) {
            unset($_POST['pin']);
            unset($_SESSION['pin']);
        }

        return $pin;
    }

    public function signIn(string $username): void
    {
        $_SESSION['username'] = $username;
    }
}
