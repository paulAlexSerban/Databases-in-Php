include .env

install: 
	docker-compose up -d --build

start:
	docker-compose up -d

down:
	docker-compose down

uninstall: backup-db
	docker-compose down -v && make clean

backup-db:
	docker exec ${COMPOSE_PROJECT_NAME}_mysql /usr/bin/mysqldump -u root --password=${DATABASE_ROOT_PASSWORD} ${COMPOSE_PROJECT_NAME} > mysql/backup/main.backup.sql

restore-db:
	@if [ -f mysql/backup/main.backup.sql ]; then \
		echo 'RESTORING database'; \
		sudo make copy-db-bkp; \
		docker exec -it ${COMPOSE_PROJECT_NAME}_mysql bash -c 'mysql -u root --password=${DATABASE_ROOT_PASSWORD} ${COMPOSE_PROJECT_NAME} < /var/lib/mysql/main.backup.sql'; \
		echo 'RESTORED database'; \
	else \
		echo 'NO database to restore'; \
	fi \

copy-db-bkp:
	sudo cp -rv ./mysql/backup/main.backup.sql ./mysql/src/

clean:
	sudo rm -rf ./mysql/src/*