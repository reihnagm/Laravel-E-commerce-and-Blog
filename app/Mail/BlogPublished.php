<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogPublished extends Mailable
{
    
    use Queueable, SerializesModels;

    public function __construct()
    {
     
    }

    public function build()
    {
        return $this->from('dari@admin.com')->view('emails.blog');
    }

}
