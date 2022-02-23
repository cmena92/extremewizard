<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'es-ES',
    'timeZone'=>'America/Costa_Rica',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
		'modules' => [
			 'gridview' => [
				'class' => '\kartik\grid\Module',
				// enter optional module parameters below - only if you need to
				// use your own export download action or custom translation
				// message source
				//'downloadAction' => 'gridview/export/download',
				// 'i18n' => []
			]
		],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '-ftIzLqIVCVQA9Tj6vAAhPeO9KTXY-wi',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/
		'mail' => [
             'class' => 'yii\swiftmailer\Mailer',
             'transport' => [
                  'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
               'host' => 'mail.webcomcostarica.com',
                'port' => '465', 
                'username' => 'fe@webcomcostarica.com',
                'password' => 'T7Y+vI%hQVkG', 
                // 'encryption' => 'tls', // It is often used, check your provider or mail server specs
             ],
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
		'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            // Use pretty URLs
            'enablePrettyUrl' => true,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
            ],
        ],
		'firebase' => [
			'class'=>'grptx\Firebase\Firebase',
			'credential_file'=>'../service_account.json', // (see https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app)
			'database_uri'=>'https://extremetech-4c535-default-rtdb.firebaseio.com', // (optional)
		]
		/*'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js',
                    ]
                ],
            ],
        ],
		
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['198.204.249.27','201.191.198.120','127.0.0.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['198.204.249.27','201.191.198.120','127.0.0.1'],
    ];
}

return $config;
