<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Cart;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class CartController extends AControllerBase
{
    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $food = Cart::getAll();
        return $this->html($food);
    }


    public function delete() {

        $name = $this->request()->getValue('name');
        $cartToDelete = Cart::getAll("username = ?", [ $name ]);
        if ($cartToDelete) {
           foreach ($cartToDelete as $cart) {
               $cart->delete();
           }
        }
        return $this->redirect("?c=food");
    }

    public function store() {
        $username = $this->test_input($this->request()->getValue('userName'));
        $foodId = $this->test_input($this->request()->getValue('foodId'));
        $cartToMake = Cart::getAll("username = ? AND food_id = ?", [ $username,$foodId ]);
        if ($cartToMake) {
            foreach ($cartToMake as $cart) {
                $count = $cart->getCount();
                $cart->setCount($count+1);
            }
            return NULL;
        }
        $cart =  new Cart();
        $cart->setUsername($username);
        $cart->setFoodId($foodId);
        $cart->setCount(1);
        $cart->save();
        return NULL;
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
        return $this->redirect("?c=food");

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
