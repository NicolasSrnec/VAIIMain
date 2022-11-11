<?php

namespace App\Auth;

class LoginAuthenticator extends DummyAuthenticator
{
    /**
     * Verify, if the user is in DB and has his password is correct
     * @param $login
     * @param $password
     * @return bool
     * @throws \Exception
     */
    function login($login, $password): bool
    {
        if ($login == self::LOGIN && password_verify($password, self::PASSWORD_HASH)) {
            $_SESSION['user'] = self::USERNAME;
            return true;
        } else {
            return false;
        }
    }

}