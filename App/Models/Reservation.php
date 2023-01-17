<?php

namespace App\Models;

use App\Core\Model;

class Reservation extends Model
{
    protected $id;
    protected $res_username;
    protected $reserved;


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
    public function getResUsername()
    {
        return $this->res_username;
    }

    /**
     * @param mixed $userName
     */
    public function setResUserName($userName): void
    {
        $this->res_username = $userName;
    }

    /**
     * @return mixed
     */
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * @param mixed $reserved
     */
    public function setReserved($reserved): void
    {
        $this->reserved = $reserved;
    }

}
