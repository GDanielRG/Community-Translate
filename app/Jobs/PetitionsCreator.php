<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\TranslationPetition;
use App\TranslationRequest;
use Carbon\Carbon;

class PetitionsCreator implements ShouldQueue
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
        while (true) {
            $requests = TranslationRequest::where('closed', false)->get();
            foreach ($requests as $request) {
                if($request->last_petition->diffInMinutes(Caron::now()) > 3)
                {
                    $petitionedUsers = $request->users->pluck('id');
                    $languagesNeeded = $request->user->languages()->where('id', '<>', $request)->pluck('id');
                    $canTranslate =
                    foreach ($languagesNeeded as $languageNeeded) {
                        # code...
                    }
                }
            }
        }
    }
}
