<?php

namespace App\Services\Telegram;

use App\Exceptions\TelegramBotApiException;
use Exception;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{

    private const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, int $chat_id, string $message): bool
    {
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chat_id,
                'text' => $message,
            ])
                ->throw()
                ->json();

            return $response['ok'] ?? false;
        } catch (Exception $e) {
            report(new TelegramBotApiException($e->getMessage()));

            return false;
        }
    }
}