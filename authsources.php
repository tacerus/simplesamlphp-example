<?php

$config = [
    'admin' => [
        'core:AdminPassword',
    ],

    'example-ldap' => [
        'ldap:Ldap',
        'connection_string' => 'ldap://localhost',
        'encryption' => 'none',
        'version' => 3,
        'ldap.debug' => true,
        'options' => [
            // Possible values are 0x00 (NEVER), 0x01 (SEARCHING),
            //   0x02 (FINDING) or 0x03 (ALWAYS).
            'referrals' => 0x00,
            'network_timeout' => 3,
        ],
        'connector' => '\SimpleSAML\Module\ldap\Connector\Ldap',
        'attributes' => null,
        'attributes.binary' => [
            'jpegPhoto',
            'objectGUID',
            'objectSid',
            'mS-DS-ConsistencyGuid'
        ],
        'dnpattern' => 'uid=%username%,ou=people,dc=example,dc=com',
        'search.enable' => false,
        'search.base' => [
            'ou=people,dc=example,dc=org',
        ],
        'search.scope' => 'sub',
        'search.attributes' => ['uid', 'mail'],
        'search.filter' => '(&(objectClass=Person)(|(sn=Doe)(cn=John *)))',
        'search.username' => null,
        'search.password' => null,
    ],
];
