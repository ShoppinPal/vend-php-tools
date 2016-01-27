<?php
/**
 * Bootstrap of the application.
 */

use YapepBase\Application;
use YapepBase\Config;
use YapepBase\Debugger\ConsoleDebuggerRenderer;
use YapepBase\Debugger\DebuggerRegistry;
use YapepBase\DependencyInjection\SystemContainer;
use YapepBase\ErrorHandler\DebugErrorHandler;

/** The application root directory. */
define('APP_ROOT', realpath(__DIR__));
// Include the common bootstrap
require realpath(__DIR__ . '/../../bootstrap.php');

// Include the application specific configurations
require realpath(__DIR__ . '/config.php');

if (Config::getInstance()->get('application.debuggerEnabled')) {
    $debuggerRegistry = new DebuggerRegistry();
    $debuggerRegistry->addRenderer(new ConsoleDebuggerRenderer());

    Application::getInstance()->getDiContainer()->setDebugger($debuggerRegistry);
    Application::getInstance()->getDiContainer()->getErrorHandlerRegistry()->addErrorHandler(new DebugErrorHandler());

    unset($debuggerRegistry);
}

$diContainer = Application::getInstance()->getDiContainer();

// Set search namespaces
$diContainer->setSearchNamespaces(SystemContainer::NAMESPACE_SEARCH_CONTROLLER, array(
    '\\Www\\Controller',
));

$diContainer->setSearchNamespaces(SystemContainer::NAMESPACE_SEARCH_BO, array(
    '\\Www\\BusinessObject',
    '\\VendTools\\BusinessObject',
));

$diContainer->setSearchNamespaces(SystemContainer::NAMESPACE_SEARCH_DAO, array(
    '\\VendTools\\Dao',
));

$diContainer->setSearchNamespaces(SystemContainer::NAMESPACE_SEARCH_VALIDATOR, array(
    '\\Www\\Validator',
    '\\VendTools\\Validator',
));

$diContainer->setSearchNamespaces(SystemContainer::NAMESPACE_SEARCH_TEMPLATE, array(
    '\\Www\\View\\Template',
));

unset($diContainer);
