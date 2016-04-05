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

Cloning into this repository
```
linuxuser@machine:~$git clone https://github.com/captaincode0/silex-skeleton.git
lunuxuser@machien:~$cd silex-skeleton
```

### Environment variables
The environment variables are in controlles/app.php file, these variables are contained into application pimple container and compose the application url, but you can extend your application.
```php
class MyApplicationClass extends Application{
	use Application\TwigTrait;
	use Application\UrlGeneratorTrait;
	use Application\MonologTrait;

	public function __construct(array $values = array()){
		parent::__construct($values);

		//deploy application
		$this["debug"]=true;
		$this["production"]=false;
		$this["https"]=false;
		$this["asset.url"]=false;
		$this["prefix-production.host"]="://silexskeleton.herokuapp.com/";
		$this["prefix.host"]="://www.myhost.com/myapp/";
		$this["host"] = ($this["production"])?$this["prefix-production.host"]:$this["prefix.host"];
		$this["host"] = ($this["https"])?"https".$this["host"]:"http".$this["host"];
	...
	...
```

Variable | Explanation | Possible values
---|---|---
debug | application debug variable | boolean
production|this variable deploys asset into a production environment|boolean
https|set https into environment variables|boolean
asset.url|concatenate the url with the assets|boolean
prefix-production.host|prefix of production host|string [format: ~://host~]
prefix.host|prefix for main host| string [format: ~://host]


### Virtual host

### General troubles of deployment
#### ModRewrite

Enable ModRewrite on GNU/Linux:
```
linuxuser@machine:~$a2enmode rewrite
```

## Author
- Diego De Santiago
	- username: captaincode0
	- email: developerdiego0@gmail.com
