<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace Model;

/**
 *
 */
class ContactManager extends AbstractManager
{
    const TABLE = 'contact';
    const TABLE_JOIN = 'civility';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(): array
    {
        return $this->pdoConnection->query('SELECT co.id, co.lastname, co.firstname, co.created_at, ci.civility FROM ' .
            $this->table . ' as co INNER JOIN ' .
            self::TABLE_JOIN . ' as ci ON co.civility_id = ci.id', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }


    /**
     * INSERT one row in dataase
     *
     * @param Array $data
     */
    public function insert(array $data)
    {
        $statement = $this->pdoConnection->prepare("INSERT INTO $this->table (lastname, firstname, civility_id) VALUES (:lastname, :firstname, :civility_id)");
        $statement->bindValue('lastname', $data['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $data['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('civility_id', $data['civility_id'], \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @param int   $id   Id of the row to update
     * @param array $data $data to update
     */
    public function update(int $id, array $data)
    {
        $statement = $this->pdoConnection->prepare("UPDATE $this->table SET lastname = :lastname, firstname = :firstname, civility_id = :civility_id WHERE id = :id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('lastname', $data['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $data['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('civility_id', $data['civility_id'], \PDO::PARAM_INT);
        $statement->execute();
    }
}
