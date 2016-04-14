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
```bash
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
asset.url|concatenate the domain url with the assets|boolean
override|it's for override the domain url --web application is allowed|boolean
prefix-production.host|prefix of production host|string [format: ~://host~]
prefix.host|prefix for main host| string [format: ~://host]


### Virtual host

>Virtual hosting is a method to allow multiple domain names in one machine, for example in your localhost you could have site1.com and site2.com.

- How to SetUp a virtual host
	- [Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts)
	- [Windows](http://foundationphp.com/tutorials/apache_vhosts.php)
	- [OSx](https://coolestguidesontheplanet.com/set-virtual-hosts-apache-mac-osx-10-9-mavericks-osx-10-8-mountain-lion/)

- [What is a virtual host](https://httpd.apache.org/docs/current/vhosts/)

Configuration of a virtual host in GNU/Linux, first look at the next file vhosts.conf

```
	<VirtualHost *:80>
        ServerName yourvirtualhost.com
        ServerAlias www.yourvirtualhost.com
        ServerAdmin admin@yourvirtualhost.com
        DocumentRoot /var/www/html/yourvirtualhost.com

        ErrorLog /var/log/apache2/yourvirtualhost-error.log
        CustomLog /var/log/apache2/yourvirtualhost-access.log combined

        <Directory /var/www/html/yourvirtualhosts>
                Options Indexes FollowSymLinks
                AllowOverride All
                Order allow,deny
                Allow from all
        </Directory>
	</VirtualHost>
```

This file is composed by the next sections:
	- ServerName: Is the name of the virtual host at this example `yourvirtualhost.com`
	- ServerAlias: Is the alis of the virtual host at this example `www.yourvirtualhost.com`
	- ServerAdmin: Is the email of sysadmin.
	- DocumentRoot: Is the root folder, where the code is.
	- ErrorLog: Is the file when the server writes the errors, generally are writen in `/var/log/apache2`. 
	- CustomLog: Is the file when the server writes a custom log.
	- Directory: Change te access and enable modules to the root directory.

To enable your virtual host, you need to move the virtual host file to `/etc/apache2/sites-available`, with the next commands

```bash
	linuxuser@machine:~/silex-skeleton$mv vhost.conf /etc/apache2/sites-available/mysite.com.conf
	linuxuser@machine:~/silex-skeleton$cd /etc/apache2/sites-available
	linuxuser@machine:~/etc/apache2/sites-available$sudo chown root:root mysite.com.conf
	linuxuser@machine:~/etc/apache2/sites-available$sudo a2ensite mysite.com.conf
	linuxuser@machine:~/etc/apache2/sites-available$sudo service apache2 reload
	linuxuser@machine:~/etc/apache2/sites-available$sudo service apache2 restart
	linuxuser@machine:~/etc/apache2/sites-available$sudo nano /etc/hosts
	
	#you need to add the next lines above IPv4 configurations
	127.0.0.1 	mysite.com
	#save and exit from file with ctrl+o and enter, the next steep is reestart networking configuration
	linuxuser@machine:~/etc/apache2/sites-available$sudo service networking restart
```

>To test your virtual host you need to access using the browser, with the next address `http://mysite.com/`

### General troubles of deployment
#### ModRewrite Disabled

>This problem shows it self when you do your virtual host, and you ant to access directly
>Your web clients cannot write `http://yourhost.com/web/index.php`, thus they write the following address `http://yourhost.com/`

Enable ModRewrite on GNU/Linux --alternative to ResourceFallback:
```
linuxuser@machine:~$a2enmode rewrite
```

Enable ModRewrite on .htacess file
```
Options -MultiViews
RewriteEngine On
RewriteBase /web
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```

###Wrong permissions on var folder
>When you try to log the application messages, probably the user ~www-data~, could have access denied by localhost.
>Thus you need to change the ACL --Access Control List of var/* folder and other folders inside.

```bash
	#for www-data user
	linuxuser@machine:~/silex-skeleton$sudo setfacl -R -m u:www-data:rwx var/log var/cache
	linuxuser@machine:~/silex-skeleton$sudo setfacl -R -d -m u:www-data:rwx var/log var/cache

	#for local user
	linuxuser@machine:~/silex-skeleton$sudo setfacl -R -m u:`whoami`:rwx var/log var/cache
	linuxuser@machine:~/silex-skeleton$sudo setfacl -R -d -m u:`whoami`:rwx var/log var/cache
		
	#mask the folder
	linuxuser@machine:~/silex-skeleton$sudo setfacl -R -m mask:rwx var/log var/cache
	linuxuser@machine:~/silex-skeleton$sudo setfacl -R -d -m mask:rwx var/log var/cache		
```

If you have a GNU/Linux system you can test this script, that change those permitions automaticly
```bash
	linuxuser@machine:~/silex-skeleton$sudo chmod 777 fix-permissions.sh
	linuxuser@machine:~/silex-skeleton$./fix-permissions.sh	
```

>To test the new changes you need to uncomment the follow code section in controllers/app.php

```php
	$this->register(new MonologServiceProvider, array(
		"monolog.logfile" => __DIR__."/../var/log/webapp-text-logger"
	));
```

Finally: check it accessing to `http://yourvirtualhost/`, then check the file var/log/webapp-text-logger and you will see content of the previous request there.

- [The solution is here](https://gist.github.com/jakzal/1791121)
- [Explanation about ACLs](https://serversforhackers.com/beyond-permissions-linux-acls)

## Deploying result
>The result when the project is deployed, is the [next](https://drive.google.com/file/d/0B4J-idyc18PdQ3QzLUl2dTBQNk0/view?usp=sharing).

## Author
- Diego De Santiago
	- username: captaincode0
	- email: developerdiego0@gmail.com

## Notes
1. This deploy just is for GNU/Linux in the future i hope add Windows support.
2. I have not tested this implementation on Windows.
3. I will do automatic deploying scripts to do more efficient the installation on different platforms.