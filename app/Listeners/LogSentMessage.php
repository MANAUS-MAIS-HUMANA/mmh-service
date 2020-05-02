<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class LogSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $destinatários = collect(array_keys($event->message->getTo()))->join(', ', ' e ');

        Log::info("E-mail de {$event->message->getSubject()} enviado para {$destinatários} com sucesso!");
    }
}
