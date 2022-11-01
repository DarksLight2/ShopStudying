<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class LinkingAccountEvent
{
    use SerializesModels;

    public function __construct(public $user)
    {
    }
}
