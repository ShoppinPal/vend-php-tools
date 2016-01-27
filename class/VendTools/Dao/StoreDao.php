<?php
namespace VendTools\Dao;

use YapepBase\Dao\DaoAbstract;
use YapepBase\Database\DbFactory;

class StoreDao extends DaoAbstract
{

    public function getList($userId)
    {
        $query = '
            SELECT
                id, user_id, domain_prefix, access_token, token_type, expires, refresh_token, created_at
            FROM
                store
            WHERE
                user_id = :userId
            ORDER BY
                domain_prefix ASC
        ';

        $params = [
            'userId' => $userId,
        ];

        return DbFactory::getConnection('vend', DbFactory::TYPE_READ_ONLY)->query($query, $params)->fetchAll();
    }

    public function create($userId, $domainPrefix, $accessToken, $tokenType, $expires, $refreshToken)
    {
        $query = '
            INSERT INTO
                store
                (user_id, domain_prefix, access_token, token_type, expires, refresh_token, created_at)
            VALUES
                (:userId, :domainPrefix, :accessToken, :tokenType, :expires, :refreshToken, NOW())
        ';

        $params = [
            'userId'       => $userId,
            'domainPrefix' => $domainPrefix,
            'accessToken'  => $accessToken,
            'tokenType'    => $tokenType,
            'expires'      => $expires,
            'refreshToken' => $refreshToken,
        ];

        DbFactory::getConnection('vend', DbFactory::TYPE_READ_WRITE)->query($query, $params);
    }

}
