<?php

namespace App\Mail;

use App\Models\TicketEmailSetting;
use App\Models\TicketReply as ModelsTicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class TicketReply extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $ticketEmailSetting;

    public $ticketReply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModelsTicketReply $ticketReply, TicketEmailSetting $ticketEmailSetting)
    {
        $this->ticketEmailSetting = $ticketEmailSetting;
        $this->ticketReply = $ticketReply;
        Config::set('app.logo', $ticketEmailSetting->company->masked_logo_url);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $previousReply = ModelsTicketReply::where('ticket_id', $this->ticketReply->ticket_id)
            ->whereNotNull('imap_message_id')->orderByDesc('id')
            ->first();

        if ($this->ticketEmailSetting->status == 1) {
            $this->from($this->ticketEmailSetting->mail_from_email, $this->ticketEmailSetting->mail_from_name)
                ->subject($this->ticketReply->ticket->subject)
                ->view('emails.ticket.reply');

            if (! is_null($previousReply) && ! is_null($previousReply->imap_message_id)) {
                ModelsTicketReply::where('id', $this->ticketReply->id)->update(['imap_message_id' => $previousReply->imap_message_id]);
            }

            return $this;
        }

        return $this;
    }
}
