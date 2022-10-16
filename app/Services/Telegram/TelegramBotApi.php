<?php

namespace App\Services\Telegram;

use App\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{

    private const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws TelegramBotApiException
     */
    public static function sendMessage(string $token, int $chat_id, string $message)
    {
        $request = Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);

        if (!$request->json()['ok']) {
            throw new TelegramBotApiException('Не удалось отправить сообщение боту в телеграм!');
        }

        return $request->json()['ok'];
    }
}