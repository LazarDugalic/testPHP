<?php

namespace App\Repository;

use App\Database;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::createInstance();
    }

    /**
     * @param $email
     * @param $name
     * @param $password
     */
    public function createNewUser($email, $name, $password)
    {
        $statement = $this->db->prepare("INSERT INTO user (email, name, password) VALUES (?, ?, ?)");
        $statement->bindValue(1, $email);
        $statement->bindValue(2, $name);
        $statement->bindValue(3, $password);

        $statement->execute();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        $statement = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $statement->bindValue(1, $email);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function userExists($email)
    {
        $statement = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $statement->bindValue(1, $email);
        $statement->execute();

        return $statement->fetch() ? true : false;
    }

    public function findByParameter($parameter) {
        $statement = $this->db->prepare("SELECT * FROM user WHERE email LIKE ? OR name LIKE ?");
        $statement->bindValue(1, '%'.$parameter.'%');
        $statement->bindValue(2, '%'.$parameter.'%');
        $statement->execute();

        return $statement->fetchAll();
    }
}
