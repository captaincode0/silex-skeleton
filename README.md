# Silex PHP Skeleton
This is a simple silex skeleton that i use for my personal projects, to deploy in my sandbox.

##Directory distribution
* src: contains all the source code of the application..
..* main-controllers.php: this file contains all the controllers mounted.
..* app.php: this file contains all the flags, services and configurations for the application.
..* controllers: this folder contains all the controllers for the PHP application.
....* ControllersLoader.php: in this file all application controllers are loaded.
..* services: this folder contains all the service providers.
....* ServicesLoader.php: in this file all services in application are included.

##Important files 
* composer.json: this file contains all the contents of vendor folder, thus to install other folders you'll need to require and install them --composer.phar require.
