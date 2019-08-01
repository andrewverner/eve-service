<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'name' => 'EVE Services',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'character' => [
            'class' => 'app\components\Character',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IELLKJFHBkR_yta1LsGfIvb9MXi8sB89',
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'sign-in' => 'site/sign-in',
                'sign-up' => 'site/sign-up',
                'sign-out' => 'site/sign-out',
                'activate/<code:\w+>' => 'site/activate',

                'character/<characterId:\d+>' => 'character/character/index',
                'character/<characterId:\d+>/agents' => 'character/character/agents',
                'character/<characterId:\d+>/assets' => 'character/character/assets',
                'character/<characterId:\d+>/bps' => 'character/character/bps',
                'character/<characterId:\d+>/bookmarks' => 'character/character/bookmarks',
                'character/<characterId:\d+>/calendar' => 'character/character/calendar',

                'character/<characterId:\d+>/industry-jobs' => 'character/character/industry-jobs',
                'character/<characterId:\d+>/planetary' => 'character/character/planetary',
                'character/<characterId:\d+>/planet/<planetId:\d+>' => 'character/character/planet',

                'character/<characterId:\d+>/service/<code>' => 'character/character/service',

                'universe/solar-system/<id:\d+>' => 'universe/solar-system-by-id',
                'universe/solar-system/<name:\w+>' => 'universe/solar-system-by-name',

                /*'character/<id:\d+>' => 'character/index',
                'character/<id:\d+>/assets' => 'character/assets',
                'character/<id:\d+>/bps' => 'character/bps',
                'character/<id:\d+>/mail-list' => 'character/mail-list',
                'DELETE character/<id:\d+>/mail/<mailId:\d+>' => 'character/drop-mail',
                'character/<id:\d+>/agents' => 'character/agents',
                'character/<id:\d+>/bookmarks' => 'character/bookmarks',
                'character/<id:\d+>/calendar' => 'character/calendar',
                'character/<id:\d+>/routes' => 'character/routes',
                'character/<id:\d+>/record-route' => 'character/record-route',
                'character/<id:\d+>/drop-route-record' => 'character/drop-route-record',
                'character/<id:\d+>/save-route' => 'character/save-route',
                'character/<id:\d+>/clear-route' => 'character/clear-route',
                'character/<id:\d+>/share-route' => 'character/share-route',
                'character/<id:\d+>/routes/<route:\d+>' => 'character/route',
                'character/<id:\d+>/set-route' => 'character/set-route',
                'character/<id:\d+>/wallet' => 'character/wallet',
                'character/<id:\d+>/kill-mails' => 'character/kill-mails',
                'character/<id:\d+>/standings' => 'character/standings',
                'character/<id:\d+>/skills' => 'character/skills',
                'character/<id:\d+>/notifications' => 'character/notifications',
                'character/<id:\d+>/mining' => 'character/mining',
                'character/<id:\d+>/services' => 'character/services',*/
                'kill-mail/<id:\d+>/<hash:\w+>' => 'eve/kill-mail',
                'pi/<mask:\d+>' => 'pi/index',
                'pi/schematic/<id:\d+>' => 'pi/schematic',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
    ],
    'params' => $params,
    'modules' => [
        'character' => [
            'class' => 'app\modules\character\Character',
            'defaultRoute' => 'CharacterController',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['192.168.100.1', '::1'],
    ];
}

return $config;
