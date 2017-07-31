<?php$params = require(__DIR__ . '/params.php');Yii::$classMap['Method'] = '@app/libs/Method.php';Yii::$classMap['UploadFile'] = '@app/libs/upload/UploadFile.php';$config = [    'id' => 'basic',    'basePath' => dirname(__DIR__),    'bootstrap' => ['log'],    'modules' => [        'user' => [            'class'=>'app\modules\user\UserModule'        ],        'cn' => [            'class'=>'app\modules\cn\CnModule'        ],        'admin' => [            'class'=>'app\modules\admin\AdminModule'        ],    ],    'components' => [        'request' => [            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation            'cookieValidationKey' => '3ggkbEhqR-n2ASj19BJSpbdvpmbO4NwK',        ],//        'cache' => [//            'class' => 'yii\caching\MemCache',//            'servers'=> [['host'=>'127.0.0.1','port'=>'11211']]//        ],        'errorHandler' => [            'errorAction' => 'site/error',        ],        'mailer' => [            'class' => 'yii\swiftmailer\Mailer',            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件            'transport' => [                'class' => 'Swift_SmtpTransport',                'host' => 'smtp.exmail.qq.com',  //每种邮箱的host配置不一样                'username' => 'news@thinkwithu.com',                'password' => 'News0114',                'port' => '465',                'encryption' => 'ssl',            ],            'messageConfig'=>[                'charset'=>'UTF-8',                'from'=>['news@thinkwithu.com'=>'申友网']            ],        ],         'urlManager' => [             'enablePrettyUrl' => true,             'showScriptName' => false,             //'suffix' => '.html',              'rules' => [//                  // 首页                  '' => 'cn/sat/index',// 首页                  'index.html' => 'cn/sat/index',// 首页                  'class.html' => 'cn/classes/index',// 课程页面                  'class_details/<id:\d+>.html' => 'cn/classes/details',// 课程详情页                  'pubclass.html' => 'cn/pubclass/index',// 公开课二级页面                  'pubclass_details/<id:\d+>.html' => 'cn/info/details',// 公开课详情页                  'info_details/<id:\d+>.html' => 'cn/info/details',// 资讯详情页                  'teachers.html' => 'cn/teachers/index',// 教师二级页                  'teachers_details/<id:\d+>.html' => 'cn/teachers/details',// 教师详情页                  'info.html' => 'cn/info/index',// 资讯二级页                  'about.html' => 'cn/about/about',// 关于我们页面                  'mock.html' => 'cn/mock/index',// 模考二级页面                  'mock_details/<id:\d+>.html' => 'cn/mock/notice',// 模考通知页面                  'mock_details' => 'cn/mock/notice',// 模考通知页面//                  'mock_details' => 'cn/mock/details',// 模考详情页面                  'knowledge.html' => 'cn/knowledge/index',// 知识库二级页面                  'mock_test' => 'cn/mock/details',// 模考详情页面                  'knowledge_details/<id:\d+>.html' => 'cn/knowledge/details',// 知识库详情页面                  'exercise.html' => 'cn/exercise/index',// 练习二级页面                  'exercise_details/<id:\d+>.html' => 'cn/exercise/exercise',// 练习详情页面                  'report/<id:\d+>.html' => 'cn/report/details',// 报告页面                  're.html' => 'cn/report/report',// 报告页面                  're_single.html' => 'cn/report/report',// 报告页面                  'surprise.html' => 'cn/sat/surprise',// 错误页面                  'person_collect.html' => 'cn/person/collect',// 个人收藏                  'person_exercise.html' => 'cn/person/exercise',// 个人练习                  'person_mock.html' => 'cn/person/mock',// 个人模考                  'search.html' => 'cn/search/index',// 搜索                  'act.html' => 'cn/act/index',// act页面                  'US_abroad.html' => 'cn/abroad/index',// act页面              ],         ],        'log' => [            'traceLevel' => YII_DEBUG ? 3 : 0,            'targets' => [                [                    'class' => 'yii\log\FileTarget',                    'levels' => ['error', 'warning'],                ],            ],        ],        'db' => require(__DIR__ . '/db.php'),    ],    'params' => $params,];if (YII_ENV_DEV) {    // configuration adjustments for 'dev' environment    $config['bootstrap'][] = 'debug';    $config['modules']['debug'] = 'yii\debug\Module';    $config['bootstrap'][] = 'gii';    $config['modules']['gii'] = 'yii\gii\Module';}return $config;