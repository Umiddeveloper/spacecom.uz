du: memory
	docker-compose up -d

dd:
	docker-compose down

db: memory
	docker-compose up --build -d

de:
	docker exec -it spacecom.uz-php sh

test:
	docker-compose exec php-cli vendor/bin/phpunit

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chown ${USER} console/migrations -R

init: db
	docker exec -it spacecom.uz-php sh -c "composer install && YII_ENV=dev php ./init --env=Development --overwrite=All && YII_ENV=dev php ./yii migrate/up --interactive=0 && chown www-data:www-data storage/ -R"

update: db
	docker exec -it spacecom.uz-php sh -c "composer update && YII_ENV=dev php ./init --env=Development --overwrite=All && YII_ENV=dev php ./yii migrate/up --interactive=0 && chown www-data:www-data storage/ -R"

rm: dd
	sudo rm docker/storage/mysql -R

rebuild: dd rm update
