<?php

namespace App\Controllers;

use App\Core\AControllerBase;
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

    public function store() {
        $user = new User();
        $user->setUsername($this->request()->getValue('username'));
        $user->setPassword($this->request()->getValue('password'));
        $user->save();
        return $this->redirect("?c=user");
    }

    public function create() {
        return $this->html(viewName: 'create.form');
    }

    public function edit() {
        $login = $this->request()->getValue('login');
        $userToEdit = User::getOne($login);
        return $this->html($userToEdit, viewName: 'create.form');
    }
}
