## Project set up

* Pull project from repository
* Port `8085` must be free, or change port mapping for `webserver` in `compose.yml` to any free
* Port `5433` must be free, or change port for `quize-postgres` in `compose.yml` to any free
* Execute `docker-compose up -d` from project root
* Execute `docker exec quize-app composer install` from project root
* Execute `docker exec quize-app ./bin/console doctrine:migrations:migrate` from project root

## Entry point
`http://127.0.0.1:8085/index`
