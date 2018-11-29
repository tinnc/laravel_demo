<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisteredUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * The order instance.
    *
    * @var Order
    */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        // $user = User::find($registered_user_id);
        return $this->view('emails.user.registered')->with('user', $user);
    }
}
