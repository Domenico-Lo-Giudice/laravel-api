<?php

namespace App\Mail;

use App\Models\Project;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublishedProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Published Project from' . env('APP_NAME')
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        $project = $this->project;
        $published_text = $project->is_published ? 'Il project è stato pubblicato' : 'Il project è stato ritirato';

        return new Content(
            markdown: 'mails.projects.published',
            with: compact('project', 'published_text')
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
