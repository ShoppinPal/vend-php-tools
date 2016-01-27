<?php
namespace VendTools\BusinessObject;

use YapepBase\Application;

class BoAbstract extends \YapepBase\BusinessObject\BoAbstract
{

    /**
     * Returns a StoreDao instance
     *
     * @return \VendTools\Dao\StoreDao
     */
    protected function getStoreDao()
    {
        return Application::getInstance()->getDiContainer()->getDao('Store');
    }

    /**
     * Returns a UserDao instance
     *
     * @return \VendTools\Dao\UserDao
     */
    protected function getUserDao()
    {
        return Application::getInstance()->getDiContainer()->getDao('User');
    }

}
