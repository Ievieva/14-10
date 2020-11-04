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

    public function signIn(int $id, string $name): void
    {
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
    }

    public function signOut(): void
    {
        unset($_SESSION['id']);
        unset($_SESSION['name']);
    }
}
