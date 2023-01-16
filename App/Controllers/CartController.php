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
        $username = $this->test_input($this->request()->getValue('userName'));
        $food = Cart::getAll("username = ?", [ $username]);
        return $this->json($food);
    }


    public function delete() {

        $username = $this->test_input($this->request()->getValue('userName'));
        $foodId = $this->test_input($this->request()->getValue('foodId'));
        $cartToDelete = Cart::getAll("username = ? AND food_id = ?", [ $username,$foodId ]);;
        if ($cartToDelete) {
            $count = $cartToDelete[0]->getCount() - 1;
            if ($count <= 0) {
                $cartToDelete[0]->delete();
            } else {
                $cartToDelete[0]->setCount($count);
            }
            $cartToDelete[0]->save();
        }
        return $this->json($cartToDelete);
    }

    public function store() {
        $username = $this->test_input($this->request()->getValue('userName'));
        $foodId = $this->test_input($this->request()->getValue('foodId'));
        $foodName =$this->test_input($this->request()->getValue('foodName'));
        $foodPrice = $this->test_input($this->request()->getValue('foodPrice'));
        $cartToMake = Cart::getAll("username = ? AND food_id = ?", [ $username,$foodId ]);
        if ($cartToMake) {
            $count = $cartToMake[0]->getCount() + 1;
            $cartToMake[0]->setCount($count);
            $cartToMake[0]->save();
            return $this->json($cartToMake[0]);
        }
        $cart =  new Cart();
        $cart->setUsername($username);
        $cart->setFoodId($foodId);
        $cart->setCount(1);
        $cart->setFoodName($foodName);
        $cart->setFoodPrice($foodPrice);
        $cart->save();
        return $this->json($cart);
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
