SickyNotes Module inspired by bigemployee's Big-Sticky-Notes Module and using Doctrine2 & JQuery
======================================

##Introduction

SickyNotes Module inspired by [bigemployee](https://github.com/bigemployee/Big-Sticky-Notes)'s Big-Sticky-Notes Module and using Doctrine2 & JQuery

##Installation Using Composer

The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies:

    curl -s https://getcomposer.org/installer | php --

You would then invoke `composer` to install dependencies. Add to your composer.json

	"antuan-sehikyan/image-manager": "dev-master"        
        
##Required Modules

	"doctrine/doctrine-module": "0.*",  
	"doctrine/doctrine-orm-module": "0.*",	
    "ledsinclouds/leds-sticky-notes": "dev-master"
	        
##Configuration

Once module installed, you could declare the module into your __"config/application.config.php"__ by adding: 
	
        'Application',	
        'DoctrineModule',
		'DoctrineORMModule',
        'LedsStickyNotes',						         	

Copy/Paste the configuration file and change configuration options according to your social accounts.
Note: You must create applications for that...

    cp vendor/antuan-sehikyan/image-manager/config/doctrine.local.php.dist config/autoload/doctrine.local.php
	
##Create your Database:

	./vendor/bin/doctrine-module orm:validate-schema
	./vendor/bin/doctrine-module orm:schema-tool:update --force
