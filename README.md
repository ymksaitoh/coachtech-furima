# アプリ名　：　coachtech-furima

●環境構築
　Dockerビルド
 ・git clone
 ・cd
 ・git checkout coachtech-furima
 ・docker-compose up -d --build

　Laravel環境構築
 ・docker compose exec php bash
 ・composer create-project "laravel/laravel=8*" . --prefer-dist
 ・cp .env.example .env
 ・php artisan key:generate
 ・php artisan migrate
 ・php artisan db:seed

●環境開発
 ・phpMyAdmin : http://localhost:8080
 ・mailhog : http://localhost:8025
 ・商品一覧（トップ）画面　: http://localhost/index

●使用技術(実行環境)
 ・php : 8.1.33
 ・Laravel : 8
 ・MySQL : 8.0.26
 ・nginx : 1.21.1
