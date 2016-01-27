<?php
/**
 * The entry point of the application.
 */

use Common\Storage\StorageFactory;
use YapepBase\Application;
use YapepBase\Session\HttpSession;

use VendTools\ApplicationResourceManager;

require_once __DIR__ . '/../bootstrap.php';

$application     = Application::getInstance();
$resourceManager = new ApplicationResourceManager();

$request = $resourceManager->getRequest(ApplicationResourceManager::APPLICATION_WWW);
$application->setRequest($request);
$application->setResponse($resourceManager->getResponse(ApplicationResourceManager::APPLICATION_WWW));
$application->setRouter($resourceManager->getRouter(ApplicationResourceManager::APPLICATION_WWW, $request));

$application->getDiContainer()->getSessionRegistry()->register(new HttpSession('www',
	StorageFactory::get('session'), $application->getRequest(), $application->getResponse(), true));

unset($request, $resourceManager);

$application->run();
