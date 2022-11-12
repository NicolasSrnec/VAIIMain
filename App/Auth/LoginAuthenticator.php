<?php

namespace App\Auth;
use App\Core\Responses\Response;
use App\Models\User;
use App\Core\DB\Connection;
use App\Helpers\Inflect;
use PDO;
use PDOException;

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
        $pr = Connection::connect()->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $pr->execute([$login, $password]);
        $user = $pr->fetchAll();
        if ($user) {
                $_SESSION['user'] = $login;
                return true;
            } else {
                return false;
            }
    }

}