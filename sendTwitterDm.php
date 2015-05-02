<?php

$execFile = array_shift($argv);

$screenName = array_search('-n', $argv);
$screenName = $screenName !== false ? $argv[++$screenName] : array_search('--screen-name', $argv);
$screenName = $screenName ?: null;
$message    = array_search('-m', $argv);
$message    = $message !== false ? $argv[++$message] : array_search('--message', $argv);
$message    = $message ?: null;
$verbose    = in_array('-v', $argv) || in_array('--verbose', $argv);

if (!$screenName || !$message || in_array($argv[1], ['--help', '-help', '-h', '-?'])) : ?>

Twitterを使用して、指定したユーザにダイレクトメッセージを送信します。

  使用法:
  <?php echo $execFile; ?> -n NAME -m MESSAGE <options>

  --help, -help, -h, あるいは -? を指定すると、
  このヘルプが表示されます。

  -n, --screen-name NAME    ダイレクトメッセージを送信する対象
  -m, --message MESSAGE     送信するメッセージ
  -v, --verbose

<?php exit; endif;

if ($verbose) var_dump($screenName, $message);

require_once './vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$secret = parse_ini_file(getenv('HOME')."/etc/secret", true);

$TwitterOAuth = new TwitterOAuth($secret['twitter']['consumerKey'], $secret['twitter']['consumerSecret'], $secret['twitter']['accessToken'], $secret['twitter']['accessTokenSecret']);
$TwitterOAuth->host = 'https://api.twitter.com/1.1/';
if ($verbose) var_dump($TwitterOAuth);

$directMessage = $TwitterOAuth->post(
    'direct_messages/new',
    [
        'text'        => $message,
        'screen_name' => $screenName
    ]
);
if (count($directMessage->errors) > 0) {
    foreach ($directMessage->errors as $i => $obj) {
        echo "{$obj->code}: {$obj->message}";
    }
    exit(1);
}
if ($verbose) var_dump($directMessage);

