# exo_alternance

The source code is on dev branch

This project is configured with 
* Last version of Symfony
* Php version 8.1.0
* Bootstrap version 5.1.3
* Wampserver 
    * Php version 7.4.26
    * MySQL version 8.0.27

### Documentation used
* Symfony : https://symfony.com/doc/current/index.html
* Twig : https://twig.symfony.com/doc/2.x/
* Php : https://www.php.net/docs.php
* Javascript : https://developer.mozilla.org/fr/docs/Web/JavaScript
* Bootstrap : https://getbootstrap.com/docs/5.1/getting-started/introduction/

### DataBase installation
Use Symfony commands

1. php .\bin\console doctrine:database:create alias d:d:c
2. php .\bin\console make:migration alias m:migration (optional)
3. php .\bin\console doctrine:migration:migrate alias d::m::m
4. php .\bin\console doctrine:fixtures:load alias d:f:l

### Downloads links
* Project : https://github.com/NysoS/exo_alternance.git
* Wampserve : https://sourceforge.net/projects/wampserver/