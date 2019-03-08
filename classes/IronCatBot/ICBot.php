<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 03.09.2018
 * Time: 13:42
 */

namespace IronCatBot\IronCatBot;

use IronCatBot\Debug\Debug;

class ICBot
{

    const URL_API = 'https://api.telegram.org/bot';

    const DOMAIN_BOT = 'https://ironcatbot.herokuapp.com';

    public $DOCROOT = '';

    public function __construct()
    {
        $this->DOCROOT = $_SERVER['DOCUMENT_ROOT'];
    }

    public static function GetToken()
    {
        return getenv('TOKEN');
    }

    public static function getUrlApi()
    {

        return self::URL_API . self::GetToken();
    }

    public function getJson()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function getTypes()
    {

        $json = self::getJson();
        if ($json['message']) {
            if ($json['message']['entities']) {
                $type = $json['message']['entities'][0]['type'];
            } else {
                $type = $json['message']['chat']['type'];
            }
        } elseif ($json['channel_post']) {
            $type = $json['channel_post']['chat']['type'];
        } else {
            $type = 'unknown';
        }

        return $type;

    }

}