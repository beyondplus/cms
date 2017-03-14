#Beyond Plus CMS (2.1.0 Beta)
Beyond Plus CMS is the modular based Content Management System. It support to create websites and web application quickly. 

##Requirement

* PHP 5.6 greater or equal
* Database
* [Composer](https://getcomposer.org)
* [Nodejs](https://nodejs.org)

#Installation

##Terminal and Database connect

* composer create-project --prefer-dist beyondplus/cms projectname
* create database and configuration in .env (or) vi .env
* composer update
* composer dump-autoload
* php artisan optimize
* php artisan migrate:refresh --seed
* npm install

##Usage
* siteurl.com/bp-admin/login

##Themes
* Modules/Theme/Resources/views

##Theme Assets
* public/assets/

##Default Email and Password
* email 	: root@email.com
* password	: root

#For Developer
##Custom Module
* php artisan module:make name-of-your-module
* php artisan module:use {module_alias_name} 

##Dashboard
* npm run watch

##We used Technology
* Laravel 5.4 Framework
* Vue JS 2
* Jquery
* Bootstrap CSS Framework
* Gentelella ( CSS Admin Panel )
* font-awesome

##Frontend Screenshot
![alt text](https://github.com/BeyondPlusTrainingCentre/cms/raw/master/frontend.png "Front Screenshot")

##Backend Screenshot
![alt text](https://github.com/BeyondPlusTrainingCentre/cms/raw/master/backend.png "Backend Screenshot")

##Security Vulnerabilities

If you discover a security vulnerability within Beyond Plus CMS, please send an e-mail to San Pwint Thu at sanpwintthu@hotmail.com.

##License

The Beyond Plus CMS is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

##Our Website

[www.beyondplus.net](http://www.beyondplus.net)

##Youtube Video

[https://www.youtube.com/watch?v=WV9rfMdqmh0](https://www.youtube.com/watch?v=WV9rfMdqmh0)

##Donate the Beer

* CB Bank Account No  : 0010600500612014
* KBZ Bank Account No : 99930799902832301
