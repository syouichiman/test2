# お問い合わせフォーム

##環境構築

##Dockerビルド

1.git clone
2.docker-compose up-d--build

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを
編集してください。

##Laravel環境構築

1.docker-compose exec php bash
2.composer install
3..env.exampleファイルから.envを作成し、環境変数を変更
4.php artisan key:generate
5.php artisan migrate
6.php artisan db:seed

##使用技術
・PHP 8.4.5
・Laravel Framework 8.83.29
・MySQL 9.2.0

## ER図

https://github.com/syouichiman/test2/issues/1#issue-3054492096


## URL
・開発環境:http://localhost/
・phpMyAdmin:http://localhost:8080/
