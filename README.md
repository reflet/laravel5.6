# Laravel5.6
Laravel5.6環境構築の雛形です。

## 前提条件
- dockerをインストールしていること
- docker-composeをインストールしていること

下記vagrant環境で実行する場合は、上記条件を満たしています。
* [Docker Toolbox on macOS](https://docs.docker.com/toolbox/toolbox_install_mac/)

## コードの配置
必要となるコードをリポジトリからcloneして配置します。
```bash
$ mkdir -p ~/workspace/laravel5.6/ && cd ~/workspace/laravel5.6/
$ git clone https://github.com/reflet/laravel5.6.git .
```

## dockerイメージの作成
下記コマンドにてdockerのイメージを作成します。
```bash
$ docker-compose build --no-cache
```

## 環境設定ファイルの作成
Laravelの環境設定ファイルと暗号化キーを作成します。
```bash
$ docker-compose run --rm php cp .env.example .env
$ docker-compose run --rm php php artisan key:generate
```

## 各サーバ起動
下記コマンドにて、dockerコンテナを起動します。
```bash
$ docker-compose up -d
```
ブラウザで「http://localhost」にアクセスしてみる。
```bash
$ open http://localhost
```
## 各サーバ停止
```bash
$ docker-compose stop
```

## 各サーバ破棄
下記コマンドにてDBデータも含めて削除されます。  
```bash
$ docker-compose down -v
```

## artisanコマンド
Laravelのartisanコマンドの例です。
```bash
# model
$ docker-compose exec php php artisan make:model Entities/<クラス名>

# console
$ docker-compose exec php php artisan make:command <クラス名>

# migration
$ docker-compose exec php php artisan make:migration <ファイル名>
$ docker-compose exec php php artisan migrate
$ docker-compose exec php php artisan migrate:rollback --step=1

# seeder
$ docker-compose exec php php artisan make:seeder <クラス名>
$ docker-compose exec php php artisan db:seed # ( DatabaseSeeder.phpに記載すべて )
$ docker-compose exec php php artisan db:seed --class=<クラス名>

# factory
$ docker-compose exec php php artisan make:factory <クラス名>

# mail
$ docker-compose exec php php artisan make:mail <クラス名> --markdown=emails.<ファイル名>
```

テストを作成する。
```bash
$ docker-compose exec php php artisan make:test TopTest
```

テストを実行する。
```bash
$ docker-compose exec php vendor/bin/phpunit tests/Feature/TopTest.php
```

## composerコマンド
composer.jsonを変更したら下記コマンドを実行する。
```bash
# default
$ docker-compose exec php composer install
$ docker-compose exec php composer update
$ docker-compose exec php composer require <package>[:<tag>]
$ docker-compose exec php composer remove <package>
$ docker-compose exec php composer dump-autoload

# modules
$ docker-compose exec php composer install -d /var/www/www.example.com/Modules/Admin
$ docker-compose exec php composer update -d /var/www/www.example.com/Modules/Admin
$ docker-compose exec php composer require <package>[:<tag>] -d /var/www/www.example.com/Modules/Admin
$ docker-compose exec php composer remove <package> -d /var/www/www.example.com/Modules/Admin
$ docker-compose exec php composer dump-autoload -d /var/www/www.example.com/Modules/Admin
```

## yarnコマンド
package.json関係で操作する場合のコマンドは以下となります。
```bash
# default
$ docker-compose exec node yarn
$ docker-compose exec node yarn dev
$ docker-compose exec node yarn watch
$ docker-compose exec node yarn watch-poll
$ docker-compose exec node yarn add <package>
$ docker-compose exec node yarn remove <package>

# modules
$ docker-compose exec -w /app/Modules/Admin node yarn
$ docker-compose exec -w /app/Modules/Admin node yarn dev
$ docker-compose exec -w /app/Modules/Admin node yarn watch
$ docker-compose exec -w /app/Modules/Admin node yarn watch-poll
$ docker-compose exec -w /app/Modules/Admin node yarn add <package>
$ docker-compose exec -w /app/Modules/Admin node yarn remove <package>
```

## メール送信について
mailhogを利用しており、下記URLにて送信したメールを確認できます。
```
$ open http://localhost:8025
```

## AWS S3仮想環境(minio)
minioを利用しており、下記URLにて送信したメールを確認できます。
```
// 管理画面
$ open http://localhost:9090

// 画像
$ open http://localhost:9090/static/minio.png
```

## Laravel5.6の再インストール
下記のようにsrcフォルダを削除して、create-projectコマンドを実行し、Laravelプロジェクトを再作成します。
```bash
$ rm -rf ./src
$ docker-compose -f docker-compose.init.yml run --rm composer create-project "laravel/laravel=5.6.*" .
```

## IDEなどで開発する場合
下記フォルダは、パフォーマンスを向上させるため、host側のフォルダをマウントしていません。  
- ./src/vendor
- ./src/node_modules

IDEなどで開発する際に不都合がある場合は、下記コマンドにてhost側にコピーすることもできます。
- vendorフォルダ (サーバ起動中に実行)
```bash
$ rm -rf ./src/vendor
$ docker cp laravel56_php_1:/var/www/www.example.com/vendor ./src/
```
- node_modulesフォルダ (サーバ起動中に実行)
```bash
$ rm -rf ./src/node_modules
$ docker cp laravel56_node_1:/app/node_modules ./src/
```

以上
