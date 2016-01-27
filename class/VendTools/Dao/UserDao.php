<?php

namespace VendTools\Dao;

use YapepBase\Dao\DaoAbstract;
use YapepBase\Database\DbFactory;

class UserDao extends DaoAbstract
{

    public function create($username, $passwordHash, $email)
    {
        $query = '
            INSERT INTO
                user
                (username, password, email)
            VALUES
                (:username, :passwordHash, :email)
        ';

        $params = [
            'username'     => $username,
            'passwordHash' => $passwordHash,
            'email'        => $email,
        ];

        $connection = DbFactory::getConnection('vend', DbFactory::TYPE_READ_WRITE);

        $connection->query($query, $params);

        return $connection->lastInsertId();
    }

    public function getByUserName($username)
    {
        $query = '
            SELECT
                id, username, password, email
            FROM
                user
            WHERE
                username = :username
        ';

        $params = [
            'username' => $username
        ];

        return DbFactory::getConnection('vend', DbFactory::TYPE_READ_ONLY)->query($query, $params)->fetch();
    }
}
