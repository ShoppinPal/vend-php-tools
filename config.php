<?php
/**
 * Common configuration file which should be included by every application in the project.
 *
 * @package Common
 */

use YapepBase\Config;

Config::getInstance()->set(
    array(
        // General config
        'system.project.name'             => PROJECT_NAME,

        // Session
        'resource.session.www.namespace'  => 'www',
        'resource.session.www.cookieName' => 'session',
        'resource.session.www.lifetime'   => 1800, // 30 minutes

        'resource.storage.session.storageType' => 'saslMemcached',
        'resource.storage.session.host'        => preg_replace('/:.+$/', '', getenv('MEMCACHIER_SERVERS')),
        'resource.storage.session.port'        => preg_replace('/^.+:/', '', getenv('MEMCACHIER_SERVERS')),

        'application.passwordHash.cost' => 10,

        'resource.vend.oauth.clientId'     => getenv('VEND_OAUTH_CLIENT_ID'),
        'resource.vend.oauth.clientSecret' => getenv('VEND_OAUTH_CLIENT_SECRET'),
        'resource.vend.oauth.redirectUri'  => getenv('VEND_OAUTH_REDIRECT_URI'),
    )
);

Config::getInstance()->set('application.debuggerEnabled', (bool)getenv('IS_TEST_ENVIRONMENT'));

// TODO do this in a nicer way in yapep 1.0
function setupMySqlDbConfig($varName, $dbName)
{
    $parsed = parse_url(getenv($varName));

    $config = Config::getInstance();

    $config->set(
        [
            'resource.database.' . $dbName . '.rw.backendType' => 'mysql',
            'resource.database.' . $dbName . '.rw.host'        => $parsed['host'],
            'resource.database.' . $dbName . '.rw.user'        => $parsed['user'],
            'resource.database.' . $dbName . '.rw.password'    => $parsed['pass'],
            'resource.database.' . $dbName . '.rw.database'    => ltrim($parsed['path'], '/'),
            'resource.database.' . $dbName . '.rw.port'        => $parsed['port'],
            'resource.database.' . $dbName . '.rw.charset'     => 'utf8',

            'resource.database.' . $dbName . '.ro.backendType' => 'mysql',
            'resource.database.' . $dbName . '.ro.host'        => $parsed['host'],
            'resource.database.' . $dbName . '.ro.user'        => $parsed['user'],
            'resource.database.' . $dbName . '.ro.password'    => $parsed['pass'],
            'resource.database.' . $dbName . '.ro.database'    => ltrim($parsed['path'], '/'),
            'resource.database.' . $dbName . '.ro.port'        => $parsed['port'],
            'resource.database.' . $dbName . '.ro.charset'     => 'utf8',
        ]
    );
}

setupMySqlDbConfig('JAWSDB_URL', 'vend');
