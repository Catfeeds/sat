<?php$params = require(__DIR__ . '/params.php');Yii::$classMap['Method'] = '@app/libs/Method.php';Yii::$classMap['UploadFile'] = '@app/libs/upload/UploadFile.php';$config = [    'id' => 'basic',    'basePath' => dirname(__DIR__),    'bootstrap' => ['log'],    'modules' => [        'user' => [            'class'=>'app\modules\user\UserModule'        ],        'cn' => [            'class'=>'app\modules\cn\CnModule'        ],        'admin' => [            'class'=>'app\modules\admin\AdminModule'        ],    ],    'components' => [        'request' => [            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation            'cookieValidationKey' => '3ggkbEhqR-n2ASj19BJSpbdvpmbO4NwK',        ],//        'cache' => [//            'class' => 'yii\caching\MemCache',//            'servers'=> [['host'=>'127.0.0.1','port'=>'11211']]//        ],//        'errorHandler' => [//            'errorAction' => 'site/error',//        ],        'mailer' => [            'class' => 'yii\swiftmailer\Mailer',            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件            'transport' => [                'class' => 'Swift_SmtpTransport',                'host' => 'smtp.exmail.qq.com',  //每种邮箱的host配置不一样                'username' => 'news@thinkwithu.com',                'password' => 'News0114',                'port' => '465',                'encryption' => 'ssl',            ],            'messageConfig'=>[                'charset'=>'UTF-8',                'from'=>['news@thinkwithu.com'=>'申友网']            ],        ],         'urlManager' => [             'enablePrettyUrl' => true,             'showScriptName' => false,             //'suffix' => '.html',              'rules' => [//                  //首页                  '' => 'cn/classes/index',//首页                  'class.html' => 'cn/classes/index',//课程页面                  'class_details/<id:\d+>.html' => 'cn/classes/details',//课程详情页                  'pubclass.html' => 'cn/pubclass/index',//公开课二级页面                  'pubclass_details/<id:\d+>.html' => 'cn/info/details',//公开课详情页                  'info_details/<id:\d+>.html' => 'cn/info/details',//资讯详情页                  'teachers.html' => 'cn/teachers/index',//教师二级页                  'teachers_details/<id:\d+>.html' => 'cn/teachers/details',//教师详情页                  'info.html' => 'cn/info/index',//教师二级页                  'about.html' => 'cn/about/about',//课程页面              ],         ],        'log' => [            'traceLevel' => YII_DEBUG ? 3 : 0,            'targets' => [                [                    'class' => 'yii\log\FileTarget',                    'levels' => ['error', 'warning'],                ],            ],        ],        'db' => require(__DIR__ . '/db.php'),    ],    'params' => $params,];if (YII_ENV_DEV) {    // configuration adjustments for 'dev' environment    $config['bootstrap'][] = 'debug';    $config['modules']['debug'] = 'yii\debug\Module';    $config['bootstrap'][] = 'gii';    $config['modules']['gii'] = 'yii\gii\Module';}return $config;