# Информация по развертыванию проекта

```bash
git clone https://github.com/ruslalsur/smtest.git
cd smtest && npm install --prefix frontend
docker-compose up -d --build
docker-compose exec php composer install
docker-compose exec php symfony console doctrine:migrations:migrate
docker-compose exec php symfony console doctrine:fixtures:load
http://localhost:3000/
```

# Дополнительная информация

## Соединение с базой данных с хостовой машины

```bash
mysql -usmuser -psmuser --port=33060 smdb`
```

## Соединение с базой данных в контейнере

```bash
docker-compose exec database /bin/bash
mysql -usmuser -psmuser --port=3306 smdb
```

## Про localstorage (при посевах после запуска приложения)

Авторизации, как и логаута нету, поэтому, если сеять в базу данных после запуска приложения, уберите пользователя из localstorage руками.
