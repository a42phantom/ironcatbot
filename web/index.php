<?php

require('../vendor/autoload.php');

use IronCatBot\Classes\Bot\Bot;
use IronCatBot\Classes\Config\ConfigOther as CFG;

//Bot::Init();
//echo CFG::getUrlApi();

try {
    $bot = new \TelegramBot\Api\Client(CFG::GetToken());
    $bot->command('devanswer', function ($message) use ($bot) {
        preg_match_all('/{"text":"(.*?)",/s', file_get_contents('http://devanswers.ru/'), $result);
        $bot->sendMessage($message->getChat()->getId(),
          str_replace("<br/>", "\n", json_decode('"' . $result[1][0] . '"')));
    });
    $bot->command('qaanswer', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), file_get_contents('http://qaanswers.ru/qwe.php'));
    });
    $bot->run();
} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}