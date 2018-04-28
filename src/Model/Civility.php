<?php
/**
 * Created by PhpStorm.
 * User: rom1
 * Date: 28/04/18
 * Time:
 * PHP version 7
 */

namespace Model;

/**
 * Class Civility
 *
 */
class Civility
{
    private $id;

    private $civility;

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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param mixed $civility
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;
    }


}
