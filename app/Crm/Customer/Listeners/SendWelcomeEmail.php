<?php

namespace Crm\Customer\Listeners;

use Crm\Customer\Events\CustomerCreation;

class SendWelcomeEmail
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
     * @return void
     */
    public function handle(CustomerCreation $event)
    {
        //
    }
}
