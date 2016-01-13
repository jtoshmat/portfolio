<<<<<<< HEAD
# Packers Everywhere Bar Management App

For local dev, Homestead is strongly encouraged. Documentation here: http://laravel.com/docs/4.2/homestead#installation-and-setup
The simplest way is to follow the Manually Via Git (No Local PHP) instructions.

To set up your virtualhost for this app, open up .homestead/Homestead.yaml and add another block in the sites: group. Something like:
```
    - map: packers.dev
      to: /home/vagrant/Code/packers-webapp-v2/public
```
With whatever path to the app you used. ~/Code is the Homestead default.

**Once you make this change, you will need to reprovision your vm. To do this:
```sh
$ cd /path/to/Homestead
$ vagrant provision
     #-OR-
$ vagrant up --provision #(start w/ provision if vm isn't already running)
```
Once you have Homestead configured, check out this repo into your shared folder, and then ssh into your Homestead box, cd to the app root and run:
```sh
$ composer install
```
Once all the dependencies have been installed, you will need to configure your database.
While sshed into the homestead box:

```sh
$ mysql -uhomested -psecret
```
and then create a database:
```sh
mysql> create database packers;
```
The next thing you will need to do is add a few local configuration files.
```sh
$ touch app/config/local/database.php
$ touch app/config/local/cache.php
$ touch app/config/local/app.php
```
Add this into the app/config/local/database.php you created (change if your db settings are different):
```
<?php
return array(
    'connections' => array(
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'packers',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    ),
);
```
And then add this to the app/config/local/cache.php file you created:
```
<?php
return array(
    'driver' => 'file',
    'path' => storage_path().'/cache',
    'prefix' => 'laravel',
);
```

And finally add this to your app/config/local/app.php:
```
<?php
return array(
	'debug' => true,
	'url'   => 'http://packers.dev' //(or whatever url you are using)
);
```

## Database Migration/Seeding
To get the initial data in run this from the app root:
```sh
$ php artisan migrate --seed
```
If you want to import the existing bars **(Careful! This app can send emails and there is real data in here!)**
```sh
$ php artisan db:seed --class=BarImportSeeder
```

## Front-End Build Process
Before running this site locally, you will need to install the necessary build dependencies. Do this by running

    npm install
    
Then running

    gulp
    
This will process and copy all the necessary files to the web serving /public directory. For production purposes, you can run

    gulp --type production
    
to build the site with minifed resources.
=======
My Portfolio <br />
=========
LinkedIn Profile - https://www.linkedin.com/in/toshmatovus
<br />
Zend Certified profile - http://www.zend.com/en/yellow-pages/ZEND019221

<br />
My sample works, click on - View all of README.md 
<br />

*******
<br />
Company: <strong> Ginasink. Inc.</strong> <br />
Project:  Educational portal for kids (Facebook like).<br />
Technical details: LAMP, PHP 5x, MySQL, Laravel, Vagrant, Homestead, Javascript, CSS3, Jquery, Curl, API and more<br />
Sample code URL: https://github.com/jtoshmat/portfolio/tree/laravel <br />
Username: jontoshmatov Password: business
Visibility: Public<br />
Role: Lead Backend Platform Engineer<br />
<br />
*******

*******
<br />
Company: <strong> Blue State Digital.</strong> <br />
Project:  Packers Everywhere by NFL Green Packers team.<br />
Technical details: LAMP, PHP 5x, MySQL, Laravel, Vagrant, Homestead, Javascript, CSS3, Jquery, Curl, API and more<br />
URL: http://bars.packerseverywhere.com <br />
Username: jontoshmatov Password: business
URL for Javascript: PackersEverywhere branch <br />
URL for CSS: PackersEverywhere branch<br />
Visibility: Public<br />
Role: Lead Developer<br />
<br />
*******


*******
<br />
Company: <strong> American Family Insurance</strong> <br />
Project: Quote Request Form<br />
Technical details: LAMP, PHP 5x, MySQL, CakePHP, Javascript, CSS3, Jquery, Curl, API and more<br />
URL: https://qrf.amfam.com/<br />
URL: http://jontoshmatov.com/portfolio/amfam/intro<br />
URL for Javascript: https://qrf.amfam.com/js/main.js<br />
URL for CSS: https://qrf.amfam.com/css/main.css<br />
Visibility: Public<br />
Role: Lead Developer<br />
<br />
*******

Company: <strong>Hangit</strong><br />
Project: The HangIt™ Platform enables app publishers and marketers to electronically “hang” messages and marketing
anywhere and have their target customers notified on their smartphones when they get there. HangIt was founded on the principle that mobile location on smartphones changes everything.<br />
Technical details: LAMP, PHP 5x, MSSQL, Store Procedures, Zend Framework 2, Javascript, CSS3, Jquery, Curl, API and more<br />
URL: http://hangit.com/<br />
http://portal.hangit.com/login <br />

Project: Hangit Portal for Merchants and Admin<br />
Visibility: Public/Internal<br />
Role: Team Lead and Developer<br />
<br />
*******

Company: <strong>Healthplan Services ServiceLink OnExchage Portal</strong><br />
Project: ServiceLink℠ combines our staff of professionals and technology enabled business process expertise to effectively manage all aspects of member administration that drive operational efficiencies and to effectively manage costs of on-going operations<br />
Technical details: LAMP, IBM Z/OS PHP 5x, MySQL, DB2, Zend Framework 2, Javascript, CSS3, Jquery, Curl, API and more<br />
URL: http://www.healthplan.com/gotoexchange/servicelink/<br />
Project: Healthplan Services Portal for Governemtn Exchange program and Insurance companies<br />
Visibility: Public/Internal<br />
Role: Team Lead and Developer in migrating the old legacy framework to Zend Framework 2<br />

<br />
*******
>>>>>>> 1938e74269c048c87e54dbd69f8786cd0342da25
