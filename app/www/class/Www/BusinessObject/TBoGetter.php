<?php
namespace Www\BusinessObject;

use YapepBase\Application;

trait TBoGetter
{

    /**
     * Returns a StoreBo instance
     *
     * @return \Www\BusinessObject\StoreBo
     */
    protected function getStoreBo()
    {
        return Application::getInstance()->getDiContainer()->getBo('Store');
    }

    /**
     * Returns a UserBo instance
     *
     * @return \Www\BusinessObject\UserBo
     */
    protected function getUserBo()
    {
        return Application::getInstance()->getDiContainer()->getBo('User');
    }

}
