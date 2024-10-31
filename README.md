# laravel_test2 もぎたて

# 環境構築
Dockerビルド

docker-compose up -d --build

laravel環境開発
1.docker-compose exec php bash
2.composer install
3.envファイル作成、環境変数を変更
4.php artisan key:generate
5.php artisan migrate
6.php artisan db:seed


使用技術

.php
.laravel
.MySQL

URL

.開発環境　http://localhost/
.phpMyAdmin:http//localhost:8080/

#ER図

            +-------------------+        +-------------------+        +-------------------+
            |    products       |        | product_season    |        |    seasons        |
            +-------------------+        +-------------------+        +-------------------+
            | id (PK)           |<------| product_id (FK)   |------->| id (PK)           |
            | name              |        | season_id (FK)    |<------| name              |
            | price             |        +-------------------+        +-------------------+
            | description       |
            | image             |
            +-------------------+
