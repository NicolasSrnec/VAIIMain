<?php

namespace App\Models;

use App\Core\Model;

class Review extends Model
{
    protected $id;
    protected $userName;
    protected $foodId;
    protected $rating;
    protected $comment;


    public function getid()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setid($id): void
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getuserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setuserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getFoodId()
    {
        return $this->foodId;
    }

    /**
     * @param mixed $foodID
     */
    public function setFoodId($foodId): void
    {
        $this->foodId = $foodId;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }




}