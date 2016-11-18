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
use Illuminate\Database\Eloquent\Collection;

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

        $requests = TranslationRequest::where('closed', false)->get();
        foreach ($requests as $request) {
            if($request->last_petition->diffInMinutes(Caron::now()) > 3)
            {
                $petitionedUsers = $request->users->pluck('id');
                $languagesNeeded = $request->user->languages()->where('id', '<>', $request)->pluck('id');
                $potentialUsers = $request->language->users();
                foreach ($potentialUsers as $potentialUser) {
                    foreach ($potentialUser->languages as $language) {
                        if(in_array($language->id, $languagesNeeded) && !in_array($potentialUser->id, $petitionedUsers)
                        {
                            if($potentialUser->canReceiveTranslation())
                            {
                                $petition = TranslationPetition::create([
                                                                            'user_id' => $potentialUser->id,
                                                                            'translation_request_id' => $request->id,
                                                                            'language_id' => $language->id,
                                                                        ]);    
                            }

                        }
                    }
                }
            }
        }
    }
}
