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
        $filteredUser = User::getAll("username = ?", [ $login ]);
        if ($filteredUser) {
            $passwordHashed = $filteredUser[0]->getPassword();
            if(password_verify($password, $passwordHashed)) {
                $_SESSION['user'] = $login;
                return true;
            }
        } else {
                return false;
        }
        return false;
    }

}