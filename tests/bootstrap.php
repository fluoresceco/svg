<?php

if (empty(shell_exec('which compare'))) {
    die(<<<EOT
ImageMagick must be installed
EOT
    );
}

if (!($loader = include __DIR__ . '/../vendor/autoload.php')) {
    die(<<<EOT
You need to install the project dependencies using Composer:
$ wget http://getcomposer.org/composer.phar
OR
$ curl -s https://getcomposer.org/installer | php
$ php composer.phar install --dev
$ phpunit
EOT
    );
}

$loader->addPsr4('Fluoresce\\Svg\\Tests\\', __DIR__);
