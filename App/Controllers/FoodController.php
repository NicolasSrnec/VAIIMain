<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Food;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class FoodController extends AControllerBase
{
    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $food = Food::getAll();
        return $this->html($food);
    }

    public function delete() {

        $id = $this->request()->getValue('id');
        $foodToDelete = Food::getOne($id);
        if ($foodToDelete) {
            $foodToDelete->delete();
        }
        return $this->redirect("?c=food");
    }

    public function store() {
        $id = $this->request()->getValue('id');
        $food = ( $id ? Food::getOne($id) : new Food());
        $food->setName($this->request()->getValue('name'));
        $food->setPrice($this->request()->getValue('price'));
        $files = $this->request()->getFiles();
        $target_file = "public/images/" . basename($files["image"]["name"]);
        move_uploaded_file($files["image"]["tmp_name"], $target_file);
        $food->setImage($target_file);
        $food->save();
        return $this->redirect("?c=food");
    }

    public function create() {
        return $this->html(viewName: 'create.form');
    }

    public function edit() {
        $id = $this->request()->getValue('id');
        $foodToEdit = Food::getOne($id);
        return $this->html($foodToEdit, viewName: 'create.form');
    }
}
