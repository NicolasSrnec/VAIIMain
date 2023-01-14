<?php

namespace App\Models;

use App\Core\Model;

class Cart extends Model
{
    protected $id;
    protected $username;
    protected $food_id;
    protected $count;
    protected $food_name;
    protected $food_price;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFoodId()
    {
        return $this->food_id;
    }

    /**
     * @param mixed $food_id
     */
    public function setFoodId($food_id): void
    {
        $this->food_id = $food_id;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count): void
    {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getFoodName()
    {
        return $this->food_name;
    }

    /**
     * @param mixed $food_name
     */
    public function setFoodName($food_name): void
    {
        $this->food_name = $food_name;
    }

    /**
     * @return mixed
     */
    public function getFoodPrice()
    {
        return $this->food_price;
    }

    /**
     * @param mixed $food_price
     */
    public function setFoodPrice($food_price): void
    {
        $this->food_price = $food_price ;
    }



}


