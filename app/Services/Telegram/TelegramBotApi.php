<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{

    private const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, int $chat_id, string $message)
    {
        Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }
}