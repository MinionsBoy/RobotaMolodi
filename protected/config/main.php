<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),
        'language'=>'uk',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'user'=>array(
                    # encrypting method (php hash function)
                    'hash' => 'md5',

                    # send activation email
                    'sendActivationMail' => false,

                    # allow access for non-activated users
                    'loginNotActiv' => false,

                    # activate user on registration (only sendActivationMail = false)
                    'activeAfterRegister' => true,

                    # automatically login from registration
                    'autoLogin' => true,

                    # registration path
                    'registrationUrl' => array('/user/registration'),

                    # recovery password path
                    'recoveryUrl' => array('/user/recovery'),

                    # login form path
                    'loginUrl' => array('/user/login'),

                    # page after login
                    'returnUrl' => array('/user/profile'),

                    # page after logout
                    'returnLogoutUrl' => array('/user/login'),
                ),
        #...
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
                        'class'=>'WebUser',
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
                    'urlFormat' => 'path',
                    'showScriptName'=>false, 
                    'rules' => array(
                            // стандартное правило для обработки '/' как 'site/index'
                        '' => 'site/index',
                        // это пример добавления который заработал
                        //'secondcontroller/<action:.*>'=>'secondcontroller/<action>',
                        'user/<action:.*>'=>'user/<action>',
                        //'<action:.*>'=>'site/<action>', //закомментил а то глючило с ним
                        '<controller:\w+>/<id:\d+>' => '<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ),
		),
		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
