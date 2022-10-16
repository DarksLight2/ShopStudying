<?php

namespace App\Logging\Telegram;

use Monolog\Logger;

class TelegramLoggerFactory
{
    public function __invoke($config): Logger
    {
        $logger = new Logger('telegram');
        $logger->pushHandler(new TelegramLoggerHandler($config));

        return $logger;
    }
}