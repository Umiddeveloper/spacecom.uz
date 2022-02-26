<?php

namespace common\models;

class Telegram
{
    public static function sendMessage($text)
    {
        $token = '';
        $chatId = '';

        $params = [
            'chat_id' => $chatId,
            'parse_mode' => "HTML",
            'text' => $text
        ];

        return file_get_contents('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($params));
    }
}
