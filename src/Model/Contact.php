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
 * Class Contact
 *
 */
class Contact
{
    private $id;

    private $lastname;

    private $firstname;

    private $civility_id;

    private $created_at;

    private $updated_at;


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
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getCivilityId()
    {
        return $this->civility_id;
    }

    /**
     * @param mixed $civility_id
     */
    public function setCivilityId($civility_id)
    {
        $this->civility_id = $civility_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return new \DateTime($this->created_at);//created_at an date Object which will be formated in twig;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return new \DateTime($this->updated_at);//updated_at an date Object which will be formated in twig;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

}
