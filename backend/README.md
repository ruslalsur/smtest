# Информация по развертыванию проекта

- docker-compose up -d --build (создать контейнеры)
- docker-compose exec php /bin/bash (зайти в один из них)
- symfony console doctrine:migrations:migrate (применить миграции)
- symfony console doctrine:fixtures:load (фейковые данные)
- http://localhost:3000/ (запуск проекта)

# Дополнительная информация

## Соединение с базой данных с хостовой машины

mysql -usmuser -psmuser --port=33060 smdb

## Соединение с базой данных в контейнере

docker-compose exec database /bin/bash
mysql -usmuser -psmuser --port=3306 smdb
