# PHP Soap Service

### Requirements

- PHP >= 7.4.3
- MySQL >= 8
- Composer >= 2.0.13 

### Setting up locally

Use [composer](https://getcomposer.org/) to install all dependencies with

```shell
composer install 
```

### Troubleshooting

If you run into issues setting this up locally, reach out to me. 

Some issues you may run into includes the following extensions missing 

- php-mxl, install with `sudo apt install php-xml`
- php-mbstring, install with `sudo apt-get install php-mbstring`
- mysql pdo extension first check with `php -m | grep pdo_mysql` if missing run `apt-get install php-mysql` to install
- SOAP not found after running `phpinfo()` install `sudo apt-get install php-soap`


### Useful commands

```
# Clear composer cache 
composer clear-cache 

# Regenerate vendor/autoload
composer dump-autoload 

# Run all test  
./vendor/bin/phpunit tests --color

```

### Running locally 

Start the PHP Soap server using 

```shell
make up
```

Bring down the PHP Soap server using 

```
make down
```

If you are on a windows machine, look at the Makefile and run the commands in there directorly on your terminal
