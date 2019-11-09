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

## Laravel5.6のインストール
下記のようにsrcフォルダを削除して、create-projectコマンドを実行し、Laravelプロジェクトを作成します。
```bash
$ rm -rf ./src
$ docker-compose -f docker-compose.init.yml run --rm composer create-project "laravel/laravel=5.6.*" .
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
※ hosts設定で「192.168.99.100 www.example.com」を追加する  
※ ブラウザで「http://www.exeample.com」にアクセスしてみる  

## 各サーバ停止
```bash
$ docker-compose stop
```

## 各サーバ破棄
下記コマンドにてDBデータも含めて削除されます。  
```bash
$ docker-compose down -v
```

## Laravelについて
DB構成が変わった時には、migrationを実行する。
```bash
$ docker-compose exec php php artisan migrate
```

テストを作成する。
```bash
$ docker-compose exec php php artisan make:test TopTest
```

テストを実行する。
```bash
$ docker-compose exec php vendor/bin/phpunit tests/Feature/TopTest.php
```

## composer update
composer.jsonを変更したら下記コマンドを実行する。
```bash
$ docker-compose run --rm composer update
```

## yarn install
package.jsonを変更したら下記コマンドを実行する。
```bash
$ docker-compose run --rm node bash -c "yarn install && yarn production"
```

## メール送信について
mailhogを利用しており、下記URLにて送信したメールを確認できます。
```
http://www.example.com:8025/
```

## IDEなどで開発する場合
下記フォルダは、パフォーマンスを向上させるため、host側のフォルダをマウントしていません。  
- ./src/vendor
- ./src/node_modules

IDEなどで開発する際に不都合がある場合は、下記コマンドにてhost側にコピーすることもできます。
- vendorフォルダ (サーバ起動中に実行)
```bash
$ rm -rf ./src/vendor
$ docker cp php:/var/www/www.example.com/vendor ./src/
```
- node_modulesフォルダ (サーバ起動中に実行)
```bash
$ rm -rf ./src/node_modules
$ docker cp php:/var/www/www.example.com/node_modules ./src/
```

以上
