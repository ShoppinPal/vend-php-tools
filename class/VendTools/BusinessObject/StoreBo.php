<?php
namespace VendTools\BusinessObject;

class StoreBo extends BoAbstract
{
    public function getList($userId)
    {
        return $this->getStoreDao()->getList($userId);
    }

    public function create($userId, $domainPrefix, $accessToken, $tokenType, $expires, $refreshToken)
    {
        $this->getStoreDao()->create($userId, $domainPrefix, $accessToken, $tokenType, $expires, $refreshToken);
    }

}
