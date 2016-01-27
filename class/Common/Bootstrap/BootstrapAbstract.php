<?php
/**
 * @package    Finance
 * @subpackage Bootstrap
 */

namespace Common\Bootstrap;

use Common\Log\StdErrLogger;
use YapepBase\Application;
use YapepBase\Autoloader\AutoloaderRegistry;
use YapepBase\Autoloader\SimpleAutoloader;
use YapepBase\ErrorHandler\LoggingErrorHandler;

/**
 * Base class for bootstrapping.
 *
 * Contains helper methods that do common bootstrapping tasks.
 *
 * @package    Finance
 * @subpackage Bootstrap
 */
abstract class BootstrapAbstract
{

    /** Name of the GET param which indicates if testing mode should be used. */
    const GET_PARAM_NAME_TESTING_MODE = 'isTestingMode';

    /**
     * The autoloader instance.
     *
     * @var \YapepBase\Autoloader\IAutoloader
     */
    protected $autoloader;

    /**
     * Indicates if the current run is an internal test.
     *
     * @var bool
     */
    protected $isInnerTesting = false;

    /**
     * Defines the environment constants.
     *
     * @return void
     */
    protected function defineEnvironmentConstants()
    {
        /** Environment name for development. */
        define('ENVIRONMENT_DEV', 'dev');
        /** Environment name for development. */
        define('ENVIRONMENT_TEST', 'test');
        /** Environment name for staging. */
        define('ENVIRONMENT_STAGING', 'staging');
        /** Environment name for production. */
        define('ENVIRONMENT_PRODUCTION', 'production');
    }

    /**
     * Sets up the simple autoloader.
     *
     * @param string $vendorDir           Full path to the vendor directory.
     * @param string $baseClassDir        Full path to the base class directory.
     * @param string $applicationClassDir Full path to the class directory for the application, if set.
     *
     * @return void
     */
    protected function setupSimpleAutoloader($vendorDir, $baseClassDir, $applicationClassDir = null)
    {
        require_once $vendorDir . '/autoload.php';

        // Project autoloader setup
        $this->autoloader = new SimpleAutoloader();
        if (!empty($applicationClassDir)) {
            $this->autoloader->addClassPath($applicationClassDir);
        }
        $this->autoloader->addClassPath($baseClassDir);

        AutoloaderRegistry::getInstance()->addAutoloader($this->autoloader);
    }

    /**
     * Validates the environment constants.
     *
     * @return void
     *
     * @throws \Exception   If the environment is not set up correctly.
     */
    protected function verifyEnvironment()
    {
    }

    /**
     * Sets the developer and environment in the DI.
     *
     * @return void
     */
    protected function setupEnvironmentInDi()
    {
    }

    /**
     * Loads the global config.
     *
     * @param string $rootDir Full path to the root dir, that contains the config.php
     *
     * @return void
     */
    protected function loadConfig($rootDir)
    {
        // Require the config */
        require_once $this->normalizePath($rootDir) . '/config.php';
    }

    /**
     * Sets up the logging and debug data creator error handlers
     *
     * @param string $logConfigName         Name of the log config for the logging error handler.
     * @param string $fileStorageConfigName Name of the file storage config for the debug data creator.
     *
     * @return void
     */
    protected function setupErrorHandling($logConfigName = 'error', $fileStorageConfigName = 'error')
    {
        Application::getInstance()->getDiContainer()->getErrorHandlerRegistry()->addErrorHandler(
            new LoggingErrorHandler(new StdErrLogger())
        );
    }

    /**
     * Sets up application logging.
     *
     * @param string $loggerConfigName Name of the syslog config to use.
     *
     * @return void
     */
    protected function setupLogging($loggerConfigName = 'application')
    {
    }

    /**
     * Initializes the environment.
     *
     * @return void
     */
    protected function initEnvironment()
    {
        error_reporting(-1);
    }

    /**
     * Does the bootstrap for basic usage.
     *
     * Defines the environment constants, verifies the environment setup, sets up the autoloader,
     * loads the base config, sets up the normal error handling, logging, and LDAP Dao.
     *
     * @param string $rootDir                     The full path to the root directory, that contains the config.php.
     * @param string $vendorDir                   The full path to the vendor directory.
     * @param string $baseClassDir                The full path to the base class directory.
     * @param string $applicationRootDir          The full path to the application class dir.
     * @param string $errorLogConfigName          The config name for the syslog logger used to log errors.
     * @param string $debugDataCreatorStorageName The config name for the file storage used by the debug data creator.
     * @param string $applicationLogConfigName    The config name for the logger used to log application messages.
     *
     * @return void
     */
    protected function basicBootstrap(
        $rootDir,
        $vendorDir,
        $baseClassDir,
        $applicationRootDir = null,
        $errorLogConfigName = 'error',
        $debugDataCreatorStorageName = 'error',
        $applicationLogConfigName = 'application'
    ) {
        $this->initEnvironment();
        $this->defineEnvironmentConstants();
        $this->verifyEnvironment();

        $this->setupSimpleAutoloader($vendorDir, $baseClassDir, $applicationRootDir . DIRECTORY_SEPARATOR . 'class');
        $this->setupEnvironmentInDi();
        $this->loadConfig($rootDir);
        $this->setupErrorHandling($errorLogConfigName, $debugDataCreatorStorageName);
        $this->setupLogging($applicationLogConfigName);
    }

    /**
     * Normalizes a path, by removing any trailing slashes.
     *
     * @param string $path The path to normalize.
     *
     * @return string
     */
    protected function normalizePath($path)
    {
        return rtrim($path, '/\\');
    }
}
