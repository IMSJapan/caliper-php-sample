<?php

require_once('../vendor/autoload.php');

use IMSGlobal\Caliper\Client;
use IMSGlobal\Caliper\Options;
use IMSGlobal\Caliper\Sensor;
use IMSGlobal\Caliper\actions;
use IMSGlobal\Caliper\events;
use IMSGlobal\Caliper\entities;

/* 設定項目。任意の情報に書き換えること */

$endpoint = 'http://caliper.imsglobal.org/'; // 送信先URL
$apikey   = 'apikey';  // APIキー
$sensorId = 'sensorId';
$clientId = 'clientId';
$appId = 'https://example.com/app/123456789';
$appName = 'IMS-JS Caliper';

// Sensorのインスタンス作成
$sensor = new Sensor($sensorId);

$options = (new Options())
    ->setApiKey($apikey)
    ->setDebug(true)
    ->setHost($endpoint);

// Sensorインスタンスの設定
$sensor->registerClient('http', new Client($clientId, $options));

// このアプリの情報の設定
$app = (new entities\agent\SoftwareApplication($appId))
    ->setName($appName);

/**
* ログインのSessionEventを送信する。パラメタはセッションから取得する。
* 送信成功時にtrue、失敗時にfalseを返す。
*
* @return bool
*/
function sendSessionLoggedIn($user_name, $login_time)
{
    global $sensor, $app;

    $actor = (new entities\agent\Person('https://example.com/users/' . $user_name))
        ->setName($user_name);

    $session = (new entities\session\Session('https://example.com/sessions/12345'))
        ->setActor($actor)
        ->setDateCreated($login_time)
        ->setDateModified($login_time)
        ->setStartedAtTime($login_time);

    $event = (new events\SessionEvent())
        ->setActor($actor)
        ->setAction(new actions\Action(actions\Action::LOGGED_IN))
        ->setObject($app)
        ->setGenerated($session)
        ->setEventTime($login_time);

    // イベント送信
    try {

        $sensor->send($sensor, $event);
        return true;

    } catch (\RuntimeException $exception) {

        echo 'Error sending event: ' . $exception->getMessage() . PHP_EOL;
        return false;

    }
}

/**
* ログアウトのSessionEventを送信する。パラメタはセッションから取得する。
* 送信成功時にtrue、失敗時にfalseを返す。
*
* @return bool
*/
function sendSessionLoggedOut($user_name, $login_time)
{
    global $sensor, $app;

    // セッションの間隔を取得する
    $now = new DateTime();
    $duration = $now->diff($login_time);

    // BEGIN: 送信用イベントの構築
    // この部分でLoggedOutイベントの構築を行う。
    // ログイン時とは異なり、session に endedAtTime, duration が必要となる












    // END: 送信用イベントの構築


    // イベント送信
    try {

        $sensor->send($sensor, $event);
        return true;

    } catch (\Exception $exception) {

        echo 'Error sending event: ' . $exception->getMessage() . PHP_EOL;
        return false;

    }
}


/**
* DateIntervalを秒数に換算し、文字列にして返す。
* 
* @param DateInterval $interval
* @return String
*/
function getDurationString($interval)
{

  $seconds += $interval->s;
  $seconds += $interval->i * 60;
  $seconds += $interval->h * 60 * 60;
  $seconds += $interval->d * 60 * 60 * 24;
  $seconds += $interval->m * 60 * 60 * 24 * 30;
  $seconds += $interval->y * 60 * 60 * 24 * 30 * 365;

  return (string) $seconds;
}