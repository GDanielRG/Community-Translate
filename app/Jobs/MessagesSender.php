<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Message;

class MessagesSender implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        while(true){
            $messages = Message::where('sent', false)->get();
            foreach ($messages as $message) {
                \Curl::to('oneforall.herokuapp.com/oneForAll')
                ->withData( array(  'action' =>  'message',
                                    'metadata' =>   [[
                                            "service" => $message->user->lastActivePlatform,
                                            "data" => [
                                                "id" => $message->user->keys()->where('name', $message->user->lastActivePlatform)->first()->key,
                                                "text" => $message->message,
                                            ]
                                    ]],
                ) )
                ->asJson( true )
                ->post();
                $message->sent= true;
                $message->save();
            }
        }
    }
}
