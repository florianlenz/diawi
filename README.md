<h1>Diawi PHP - SDK (unofficial)</h1>

**Development**
1. Install Docker
2. Run `docker-compose up`
3. Run `docker exec -it diawiapi_app_1 bash` in order to enter the container
4. Run `composer install` in the project root.
5. Execute `vendor/phpunit/phpunit/phpunit --coverage-html .tc` to run all unit tests (code coverage will be generated as html in .tc)