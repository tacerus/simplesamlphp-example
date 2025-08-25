<?php

/**
 * The configuration of SimpleSAMLphp
 */

$httpUtils = new \SimpleSAML\Utils\HTTP();

$config = [
    'baseurlpath' => 'http://__BASE_REPLACEME__/simplesaml/',

    'application' => [],

    'cachedir' => '/var/cache/simplesamlphp',
    'certdir' => 'cert/',

    'technicalcontact_name' => 'Administrator',
    'technicalcontact_email' => 'na@example.org',

    'timezone' => null,

    'secretsalt' => '__SECRETSALT_REPLACEME__',

    'auth.adminpassword' => 'supersuper',
    'admin.protectmetadata' => false,
    'admin.checkforupdates' => false,

    'trusted.url.domains' => [],
    'trusted.url.regex' => false,

    'enable.http_post' => false,

    'assertion.allowed_clock_skew' => 180,

    'headers.security' => [
        'Content-Security-Policy' => "frame-ancestors 'self'; object-src 'none'; font-src 'self'; connect-src 'self'; base-uri 'none'",
        'X-Frame-Options' => 'SAMEORIGIN',
        'X-Content-Type-Options' => 'nosniff',
        'Referrer-Policy' => 'origin-when-cross-origin',
    ],

    'debug' => [
        'saml' => false,
        'backtraces' => true,
        'validatexml' => false,
    ],

    'showerrors' => true,
    'errorreporting' => true,

    'logging.level' => SimpleSAML\Logger::NOTICE,
    'logging.handler' => 'syslog',
    'logging.facility' => defined('LOG_LOCAL5') ? constant('LOG_LOCAL5') : LOG_USER,
    'logging.processname' => 'simplesamlphp',
    'logging.logfile' => 'simplesamlphp.log',

    'statistics.out' => [
    ],

    'proxy' => null,

    'enable.saml20-idp' => false,
    'enable.adfs-idp' => false,

    'module.enable' => [
        'exampleauth' => true,
        'core' => true,
        'admin' => true,
        'saml' => true,
        'ldap' => true,
        'suse' => true,
    ],

    'session.duration' => 8 * (60 * 60), // 8 hours.
    'session.datastore.timeout' => (4 * 60 * 60), // 4 hours
    'session.cookie.name' => 'SimpleSAMLSessionID',
    'session.cookie.lifetime' => 0,
    'session.cookie.path' => '/',

    'session.cookie.domain' => '__BASE_REPLACEME__',

    'session.cookie.secure' => false,
    'session.cookie.samesite' => 'Lax',

    'session.phpsession.cookiename' => 'SimpleSAML',
    'session.phpsession.savepath' => null,
    'session.phpsession.httponly' => true,

    'session.authtoken.cookiename' => 'SimpleSAMLAuthToken',
    'session.rememberme.enable' => true,
    'session.rememberme.checked' => false,
    'session.rememberme.lifetime' => (7 * 86400),

    'memcache_store.servers' => [
        [
            ['hostname' => 'localhost'],
        ],
    ],
    'memcache_store.expires' => 36 * (60 * 60), // 36 hours.

    'language.available' => ['en'],
    'language.rtl' => [],
    'language.default' => 'en',
    'language.parameter.name' => 'language',
    'language.parameter.setcookie' => true,
    'language.cookie.name' => 'language',
    'language.cookie.domain' => '',
    'language.cookie.path' => '/',
    'language.cookie.secure' => true,
    'language.cookie.httponly' => false,
    'language.cookie.lifetime' => (60 * 60 * 24 * 900),
    'language.cookie.samesite' => $httpUtils->canSetSameSiteNone() ? 'None' : null,

    'theme.use' => 'suse:suse',
    'theme.header' => 'Dummy Login',
    'template.auto_reload' => false,

    'production' => true,

    'assets' => [
        'caching' => [
            'max_age' => 86400,
            'etag' => false,
        ],
    ],

    'idpdisco.enableremember' => true,
    'idpdisco.rememberchecked' => true,
    'idpdisco.validate' => true,
    'idpdisco.extDiscoveryStorage' => null,
    'idpdisco.layout' => 'dropdown',

    'authproc.idp' => [
        30 => 'core:LanguageAdaptor',
        50 => 'core:AttributeLimit',
        99 => 'core:LanguageAdaptor',
        100 => array(
        	'class' => 'core:AttributeAlter',
        	'subject' => 'mfa_secret',
        	'pattern' => '/.*/',
        	'%remove',
        ),
    ],
    'authproc.sp' => [
        90 => 'core:LanguageAdaptor',
    ],

    'metadatadir' => 'metadata',
    'metadata.sources' => [
        ['type' => 'flatfile'],
    ],
    'metadata.sign.enable' => false,
    'metadata.sign.privatekey' => null,
    'metadata.sign.privatekey_pass' => null,
    'metadata.sign.certificate' => null,
    'metadata.sign.algorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256',

    'store.type'                    => 'phpsession',
    'store.sql.dsn'                 => 'sqlite:/path/to/sqlitedatabase.sq3',
    'store.sql.username' => null,
    'store.sql.password' => null,
    'store.sql.prefix' => 'SimpleSAMLphp',
    'store.sql.options' => [],
    'store.redis.host' => 'localhost',
    'store.redis.port' => 6379,
    'store.redis.username' => '',
    'store.redis.password' => '',
    'store.redis.tls' => false,
    'store.redis.insecure' => false,
    'store.redis.ca_certificate' => null,
    'store.redis.certificate' => null,
    'store.redis.privatekey' => null,
    'store.redis.prefix' => 'SimpleSAMLphp',
    'store.redis.mastergroup' => 'mymaster',
    'store.redis.sentinels' => [],

    'proxymode.passAuthnContextClassRef' => false,
];
