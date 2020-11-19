<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userDetails;
    public $project;
    public $projectManager;
    public $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDetails,$project,$projectManager,$task)
    {
        $this->userDetails=$userDetails;
        $this->project=$project;
        $this->projectManager=$projectManager;
        $this->task=$task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userDetails=$this->userDetails;
        $project=$this->project;
        $projectManager=$this->projectManager;
        $task=$this->task;
        return $this->view('manager.task-mail',compact('userDetails','project','projectManager','task'));
    }
}
