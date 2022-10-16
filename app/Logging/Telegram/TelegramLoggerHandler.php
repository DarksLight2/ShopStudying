<?php

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

final class TelegramLoggerHandler extends AbstractProcessingHandler
{

    private string $bot_token;
    private int $chat_id;

    public function __construct($config)
    {
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level);

        $this->bot_token = $config['bot_token'];
        $this->chat_id = $config['chat_id'];
    }

    protected function write(array $record): void
    {
        TelegramBotApi::sendMessage($this->bot_token, $this->chat_id, $record['formatted']);
    }
}