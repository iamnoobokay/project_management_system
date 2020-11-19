<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $projectName;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($projectName,$project)
    {
        $this->projectName=$projectName;
        $this->project=$project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $projectName=$this->projectName;
        $project=$this->project;
        return $this->view('manager.project-mail',compact($projectName,$project));
    }
}
