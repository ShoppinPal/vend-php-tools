<?php
/**
 * @package   Finance
 */

namespace VendTools;

use YapepBase\Exception\Exception;
use YapepBase\Request\HttpRequest;
use YapepBase\Router\ArrayReverseRouter;
use YapepBase\Router\ArrayRouter;

use Common\ApplicationResourceManagerAbstract;

/**
 * Resource manager class for the Finance project.
 *
 * @package    Finance
 */
class ApplicationResourceManager extends ApplicationResourceManagerAbstract
{

    /** The Admin application. */
    const APPLICATION_WWW = 'www';

    /**
     * Returns TRUE if the specified application name is valid, FALSE otherwise.
     *
     * @param string $applicationName The application's name. {@uses self::APPLICATION_*}
     *
     * @return bool
     */
    protected function checkApplicationName($applicationName)
    {
        return in_array(
            $applicationName,
            array(
                self::APPLICATION_WWW,
            )
        );
    }

    /**
     * Returns the router for the specified application.
     *
     * @param string                         $applicationName The application's name. {@uses self::APPLICATION_*}
     * @param \YapepBase\Request\HttpRequest $request         The request for the application.
     *
     * @return \YapepBase\Router\IRouter
     *
     * @throws Exception   If the application name is invalid.
     */
    public function getRouter($applicationName, HttpRequest $request)
    {
        switch ($applicationName) {
            case self::APPLICATION_WWW:
                return new ArrayRouter($request, require ROOT_DIR . '/route/app/www.php');
                break;

            default:
                throw new Exception('Invalid application name: ' . $applicationName);
        }
    }

    /**
     * Returns the reverse router for the specified application.
     *
     * @param string $applicationName The application's name. {@uses self::APPLICATION_*}
     * @param string $language        The requested language for the reverse router.
     *
     * @return \YapepBase\Router\IReverseRouter
     *
     * @throws Exception   If the application name is invalid.
     */
    public function getReverseRouter($applicationName, $language = null)
    {
        switch ($applicationName) {
            case self::APPLICATION_WWW:
                return new ArrayReverseRouter(require ROOT_DIR . '/route/app/www.php');
                break;

            default:
                throw new Exception('Invalid application name: ' . $applicationName);
        }
    }
}
