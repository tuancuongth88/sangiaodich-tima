<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     * @return void
     * @author tantan
     */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     *
     * @param  UserRegister  $event
     * @return void
     * @author tantan
     */
    public function handle(UserRegister $event)
    {
        // dd($event);
    }

    public function failed(UserRegister $event, $exception)
    {
        //
    }
}
