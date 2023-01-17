<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Reservation;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class ReservationController extends AControllerBase
{
    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $filteredReservations = Reservation::getAll();
        return $this->html($filteredReservations);
    }

    public function delete() {

        $id = $this->request()->getValue('id');
        $foodToDelete = Reservation::getOne($id);
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



    public function reserve() {
        $id = $this->request()->getValue('res_id');
        $name =$this->test_input($this->request()->getValue('res_username'));
        $resCheck = Reservation::getAll("res_username = ?", [ $name]);
        $resToEdit = Reservation::getOne($id);
        if  ($resToEdit->getReserved() == 0 && !$resCheck) {
            $resToEdit->setResUserName($name);
            $resToEdit->setReserved(1);
        }
        $resToEdit->save();
        return $this->redirect("?c=reservation");

    }

    public function Unreserve() {
        $id = $this->request()->getValue('res_id');
        $resToEdit = Reservation::getOne($id);
        $resToEdit->setResUserName("");
        $resToEdit->setReserved(0);
        $resToEdit->save();
        return $this->redirect("?c=reservation");

    }
    public function getUserReviews() {
        $userName = $this->test_input($this->request()->getValue('userName'));
        $reviews = Reservation::getAll("username = ?", [ $userName]);
        return $this->json($reviews);

    }
    public function edit() {
        $id = $this->request()->getValue('id');
        $foodToEdit = Reservation::getOne($id);
        return $this->html($foodToEdit, viewName: 'create.form');
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
