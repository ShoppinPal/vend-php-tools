<?php
/**
 * Common bootstrap which is basically responsible for initialize the framework.
 */

namespace Finance;

use Common\Bootstrap\BootstrapAbstract;

/** The repo root directory */
define('ROOT_DIR', realpath(__DIR__));

/** The base class directory */
define('BASE_DIR', realpath(ROOT_DIR . '/class'));

/** The name of the project */
define('PROJECT_NAME', 'vend-tools');

require BASE_DIR . '/Common/Bootstrap/BootstrapAbstract.php';

/**
 * Bootstrap class
 *
 * @package Finance
 */
class Bootstrap extends BootstrapAbstract
{

    /**
     * Starts the bootstrap process.
     *
     * @return void
     */
    public function start()
    {
        $this->basicBootstrap(ROOT_DIR, ROOT_DIR . '/vendor', BASE_DIR, defined('APP_ROOT') ? APP_ROOT : null);
    }
}

$bootstrap = new Bootstrap();
$bootstrap->start();
