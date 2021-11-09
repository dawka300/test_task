to start project - "docker-compose up --build"

to load fixtures - "docker-compose exec php bin/console doctrine:fixtures:load"

to fixer php - "docker-compose exec php vendor/bin/php-cs-fixer fix"

to start the unit test - "docker-compose exec php php -d memory_limit=2G vendor/bin/simple-phpunit"

to start the coverage test - "docker-compose exec php php -d extension=pcov.so -dpcov.enabled=1 -dpcov.directory=. -dpcov.exclude="~vendor~" -dpcov.initial.files=20000"

to start behat - "docker-compose exec php vendor/bin/behat"
