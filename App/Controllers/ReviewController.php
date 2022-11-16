<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Review;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class ReviewController extends AControllerBase
{
    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $food = $this->request()->getValue('food');
        $filteredReviews = Review::getAll("foodId = ?", [ $food ]);
        return $this->html($filteredReviews);
    }

    public function delete() {

        $id = $this->request()->getValue('id');
        $foodToDelete = Food::getOne($id);
        if ($foodToDelete) {
            unlink($foodToDelete->getImage());
            $foodToDelete->delete();
        }
        return $this->redirect("?c=food");
    }

    public function store() {
        $userName = $this->test_input($this->request()->getValue('user'));
        $foodId = $this->test_input($this->request()->getValue('food'));
        $pr = Connection::connect()->prepare('SELECT * FROM reviews WHERE userName = ? AND foodId = ?');
        $pr->execute([$userName, $foodId]);
        $review = $pr->fetchAll();
        if ($review == null) {
            $review = new Review();
            $review->setuserName($userName);
            $review->setFoodId($foodId);
            $review->setRating($this->test_input($this->request()->getValue('rating')));
            $review->setComment($this->test_input($this->request()->getValue('comment')));
            $review->save();
            return $this->redirect("?c=food");
        } else {
            return $this->redirect("?c=review&a=create&fail=true");
        }

    }

    public function create() {
        $failed = $this->request()->getValue('fail');
        $foodId = $this->request()->getValue('food');
        if ($failed) {
            $data = ['fail' => 'You already reviewed this product','food' => $foodId];
        } else {
            $data = ['fail' => '','food' => $foodId];
        }
        return $this->html($data, viewName: 'create.form');
    }

    public function edit() {
        $id = $this->request()->getValue('id');
        $foodToEdit = Food::getOne($id);
        return $this->html($foodToEdit, viewName: 'create.form');
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
