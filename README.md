# Silex PHP Skeleton
This is a simple silex skeleton that i use for my personal projects, to deploy in my sandbox.

## Oficial Documentation
- [Silex Framework Documentation](http://silex.sensiolabs.org/documentation)
- [Silex Framework Documentation ES-MX](https://librosweb.es/libro/silex/)
- [Composer Documentation](https://getcomposer.org/doc/)

## Directory distribution
1. src: contains all the source code of the application..
	1. main-controllers.php: this file contains all the controllers mounted.
	2. app.php: this file contains all the flags, services and configurations for the application.
	3. controllers: this folder contains all the controllers for the PHP application.
		1. ControllersLoader.php: in this file all application controllers are loaded.
	4. services: this folder contains all the service providers.
		1. ServicesLoader.php: in this file all services in application are included.
2. unittest: this folder contains application unit tests.
3. var: this folder is used for application cache and logs.
4. vendor: this folder contains the symfony 2 light framework and silex modules.
5. views: contains all the Twig templates, that application needs to render. 
	1. errors: contains all the error pages.
	2. fragments: contains all html fragments, ej. footer.
6. web: this folder contains the assets of web application.
	1. assets: this folder contain the assets of application like images, sounds, scripts, stylesheets, etc.

## Important files 
* composer.json: this file contains all the contents of vendor folder, thus to install other folders you'll need to require and install them --composer.phar require.

## How to set up your silex application.
1. Cloning repository.
2. Environment variables.
3. Virtual host.
4. General troubles of deployment.

### Cloning repository
	```
	git clone https://github.com/captaincode0/silex-skeleton.git
	cd silex-skeleton
	```

### Environment variables

### Virtual host

### General troubles of deployment
#### ModRewrite
	Enable ModRewrite on GNU/Linux:

	```
	a2enmode rewrite
	```

## Author
- Diego De Santiago
	- username: captaincode0
	- email: developerdiego0@gmail.com
