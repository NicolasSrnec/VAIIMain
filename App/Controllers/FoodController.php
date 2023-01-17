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
        $type = $this->request()->getValue('type');
        $food = Food::getAll("type = ?", [ $type]);
        //$food = Food::getAll();
        return $this->html($food);
    }


    public function delete() {

        $id = $this->request()->getValue('id');
        $foodToDelete = Food::getOne($id);
        if ($foodToDelete) {
            unlink($foodToDelete->getImage());
            $foodToDelete->delete();
        }
        return $this->redirect("?c=food&type=burger");
    }

    public function store() {
        $food =  new Food();
        $food->setName($this->test_input($this->request()->getValue('name')));
        $food->setPrice($this->test_input($this->request()->getValue('price')));
        $food->setType($this->test_input($this->request()->getValue('type')));
        $files = $this->request()->getFiles();
        $target_file = "public/images/" . basename($files["image"]["name"]);
        move_uploaded_file($files["image"]["tmp_name"], $target_file);
        $food->setImage($target_file);
        $food->save();
        return $this->redirect("?c=food&type=burger");
    }

    public function create() {
        return $this->html(viewName: 'create.form');
    }

    public function edit() {
        $id = $this->request()->getValue('id');
        $foodToEdit = Food::getOne($id);
        return $this->html($foodToEdit, viewName: 'create.form');
    }

    public function update() {
        $id = $this->request()->getValue('id');
        $name =$this->test_input($this->request()->getValue('name'));
        $price = $this->test_input($this->request()->getValue('price'));
        $files = $this->request()->getFiles();
        $target_file = "public/images/" . basename($files["image"]["name"]);
        move_uploaded_file($files["image"]["tmp_name"], $target_file);
        $foodToEdit = Food::getOne($id);
        if ($name) {
            $foodToEdit->setName($name);
        }
        if ($price) {
            $foodToEdit->setPrice($price);
        }
        if ($files["image"]["name"]) {
            unlink($foodToEdit->getImage());
            $foodToEdit->setImage($target_file);
        }
        $foodToEdit->save();
        return $this->redirect("?c=food&type=burger");

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
