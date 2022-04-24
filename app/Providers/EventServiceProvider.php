<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Mail\WarungIdeMail;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Collaboration::saved( function($collaboration)
        // {
        //     $data = [
        //         'name' => auth()->guard('api')->user()->name,
        //         'campaign_title' => session('title')
        //     ];
        //     // $subject = 'Panggilan Untuk Berkolaborasi';
        //     $user    = session('creator_email');


        //     // Mail::send( ['user' => $user], $data, function($message) use ($user, $subject){
        //     //     $message->from('no-reply@warungidea.com', 'App');
        //     //     $message->to($user)->subject($subject);
        //     // });

        //     Mail::to($user)->send(new WarungIdeMail($data));
        // });
    }
}
