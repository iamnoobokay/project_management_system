<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $taskMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($taskMessage)
    {
        $this->taskMessage=$taskMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $taskMessage=$this->taskMessage;
        return $this->view('member.task-mail');
    }
}
