twitter-direct-message
======================

# Description

Twitterを使用して、指定したユーザにダイレクトメッセージを送信します。  
車輪の再発明な気がします。  

# Install

このリポジトリをcloneします。  
composerで依存ライブラリを読み込みます。  

```
composer.phar install
```

# Usage

はじめに、例えば、以下のようなスクリプトでOAuthのセッティングを行います。  

```php
<?php

$loader = require_once './vendor/autoload.php';
$loader->add('Pit\\', ['./vendor/pit/pit/src']);


$pit = new \Pit\Pit();
$pit->set('twitter.com', ['data' => [
    'consumerKey'       => '**********',
    'consumerSecret'    => '**********',
    'accessToken'       => '**********',
    'accessTokenSecret' => '**********',
]]);

```

コマンドを叩きます。  

```
$ php sendTwitterDm.php -v -m 'こんにちは世界' -n twitter-screen-name
```

その他、ヘルプを参照します。  

```
$ php sendTwitterDm.php -h

Twitterを使用して、指定したユーザにダイレクトメッセージを送信します。

  使用法:
  sendTwitterDm.php -n NAME -m MESSAGE <options>

  --help, -help, -h, あるいは -? を指定すると、
  このヘルプが表示されます。

  -n, --screen-name NAME    ダイレクトメッセージを送信する対象
  -m, --message MESSAGE     送信するメッセージ
  -v, --verbose
```
