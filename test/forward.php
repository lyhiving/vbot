<?php
/**
 * Created by PhpStorm.
 * User: HanSon
 * Date: 2016/12/7
 * Time: 16:33
 */

require_once __DIR__ . './../vendor/autoload.php';

$robot = new \Hanson\Robot\Foundation\Robot([
    'tmp' => realpath('./tmp') . '/',
    'debug' => true,
]);

$client = new \GuzzleHttp\Client();

$robot->server->setMessageHandler(function($message) use ($client, $robot){
    if($message->type === 'Text'){
        $contact = \Hanson\Robot\Collections\Account::getInstance()->getUsernameById('hanson1994');
        \Hanson\Robot\Message\Message::send('hi', $message->rawMsg['FromUserName']);
        \Hanson\Robot\Message\Message::send($message->content, $contact);
    }
});
$robot->server->setCustomerHandler(function(){
});
$robot->server->run();
