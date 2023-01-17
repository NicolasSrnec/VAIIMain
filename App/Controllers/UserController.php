<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\User;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class UserController extends AControllerBase
{
    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $user = User::getAll();
        return $this->html($user);
    }

    public function delete() {

        $login = $this->request()->getValue('login');
        $userToDelete = User::getOne($login);
        if ($userToDelete) {
            $userToDelete->delete();
        }
        return $this->redirect("?c=user");
    }

    public function store()
    {
        $user = new User();
        $username = $this->test_input($this->request()->getValue('username'));
        $user->setUsername($username);
        $password = $this->test_input($this->request()->getValue('password'));
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user->setPassword($hashedPassword);
        $filteredUser = User::getAll("username = ?", [ $username ]);
        if ($filteredUser == null) {
            $user->save();
            $data = "Success!";
            return $this->json($data);
            //return $this->redirect("?c=home");
        } else {
            $data = "This username is already taken!";
            return $this->json($data);
            //return $this->redirect("?c=user&a=create&fail=true");
        }
    }

    public function create() {
        $failed = $this->request()->getValue('fail');
        if ($failed) {
            $data = ['fail' => 'This username is already taken'];
        } else {
            $data = ['fail' => ''];
        }
        return $this->html($data, viewName: 'create.form');
    }

    public function edit() {
        $login = $this->request()->getValue('login');
        $userToEdit = User::getOne($login);
        return $this->html($userToEdit, viewName: 'create.form');
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
